<?php

namespace app\config\app\bootstrap\exceptions;

class InstallRequiredException extends \yii\base\Exception
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Install required exception';
    }
}