<?php

class ClassLoader {
    // オートロード対象のディレクトリを保持するプロパティ
    protected $dirs;

    // クラスを読み込むメソッドをコールバックとして登録
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
        // 自分自身(ClassLoaderクラス)のloadClass()メソッドを登録
        // spl_autoload_register(コールバック)は、無名関数を入れる場合もあるけど、配列指定もできて、その場合は、[0]がインスタンス、[1]がメソッド名という風になる
    }

    public function registerDir($dir) {
        $this->dirs[] = $dir;
    }


    // register()によってオートロードに登録されたコールバック
    // $dirsプロパティに設定されたディレクトリから「クラス名.php」を探して、見つかった場合は読み込みという処理
    // こうすることで、いちいちクラスファイルをrequire()しなくて済む
    public function loadClass($class) {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' . $class . '.php';

            if (is_readable($file)) {
                require $file;
                return;
            }
        }
    }

}