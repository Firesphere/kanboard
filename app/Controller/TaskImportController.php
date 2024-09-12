<?php

namespace Kanboard\Controller;

use Kanboard\Core\Csv;
use Kanboard\Import\TaskImport;

/**
 * Task Import controller
 *
 * @package  Kanboard\Controller
 * @author   Frederic Guillot
 */
class TaskImportController extends BaseController
{
    /**
     * Upload the file and ask settings
     *
     * @param array $values
     * @param array $errors
     * @throws \Kanboard\Core\Controller\PageNotFoundException
     */
    public function show(array $values = [], array $errors = [])
    {
        $project = $this->getProject();

        $this->response->html($this->template->render('task_import/show', [
            'project'    => $project,
            'values'     => $values,
            'errors'     => $errors,
            'max_size'   => get_upload_max_size(),
            'delimiters' => Csv::getDelimiters(),
            'enclosures' => Csv::getEnclosures(),
        ]));
    }

    /**
     * Process CSV file
     */
    public function save()
    {
        $project = $this->getProject();
        $values = $this->request->getValues();
        $filename = $this->request->getFilePath('file');

        if (!file_exists($filename)) {
            $this->show($values, ['file' => [t('Unable to read your file')]]);
        } else {
            $taskImport = new TaskImport($this->container);
            $taskImport->setProjectId($project['id']);

            $csv = new Csv($values['delimiter'], $values['enclosure']);
            $csv->setColumnMapping($taskImport->getColumnMapping());
            $csv->read($filename, [$taskImport, 'importTask']);

            if ($taskImport->getNumberOfImportedTasks() > 0) {
                $this->flash->success(t('%d task(s) have been imported successfully.', $taskImport->getNumberOfImportedTasks()));
            } else {
                $this->flash->failure(t('Nothing has been imported!'));
            }

            $this->response->redirect($this->helper->url->to('TaskImportController', 'show', ['project_id' => $project['id']]), true);
        }
    }

    /**
     * Generate template
     *
     */
    public function template()
    {
        $taskImport = new TaskImport($this->container);
        $this->response->withFileDownload('tasks.csv');
        $this->response->csv([$taskImport->getColumnMapping()]);
    }
}
