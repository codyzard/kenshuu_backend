<?php

class BaseController
{
    const VIEW_FOLDER_NAME = 'views';
    const MODEL_FOLDER_NAME = 'models';

    //path name: folderName.fileName, like Laravel
    protected function view($viewPath, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $viewPath = self::VIEW_FOLDER_NAME . '/' .
            str_replace('.', '/', $viewPath) . '.php';
        if (is_file($viewPath)) {
            ob_start();
            require_once($viewPath);
            $content = ob_get_clean();
            // Sau khi có kết quả đã được lưu vào biến $content, gọi ra template chung của hệ thống đế hiển thị ra cho người dùng
            require_once('views/common/application.php');
        } else {
            return header('Location: index.php');
        }
    }

    protected function loadModel($modelPath)
    {
        require self::MODEL_FOLDER_NAME . '/' . $modelPath . '.php';
    }
}
