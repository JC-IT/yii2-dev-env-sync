<?php

declare(strict_types=1);

namespace JCIT\envSync\commands;

use console\controllers\Controller;
use JCIT\envSync\EnvSync;
use yii\console\ExitCode;
use yii\helpers\ArrayHelper;

class ExportController extends Controller
{
    public ?string $branch = null;
    public $defaultAction = 'export';
    public ?string $user = null;

    public function actionExport(): int
    {
        /** @var EnvSync $module */
        $module = $this->module;

        if (isset($this->branch)) {
            $module->branch = $this->branch;
        }

        if (isset($this->user)) {
            $module->user = $this->user;
        }

        $module->export();

        return ExitCode::OK;
    }

    public function options($actionID): array
    {
        return ArrayHelper::merge(
            parent::options($actionID),
            [
                'branch',
                'user',
            ]
        );
    }

    public function optionAliases(): array
    {
        return ArrayHelper::merge(
            parent::optionAliases(),
            [
                'b' => 'branch',
                'u' => 'user',
            ]
        );
    }
}
