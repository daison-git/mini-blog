<?php
/*
ブートストラップ: 「自動実行される」的な意味

1. クラスオートロードを行うClassLoaderクラスのインスタンス化をする
2. ClassLoader::regDirectory()の呼び出し
    - カレントディレクトリに /mvc を付加したパスと /models を付加したパスを作成
    - 上記を引数問sて ClassLoaderクラス の regDirectory() を呼び出す
    - これにより ClassLoaderクラス の $dirsプロパティ にオートロード対象のディレクトリのパスが格納される
3. ClassLoader::register()の呼び出し
    - ClassLoaderインスタンス に loadClass()メソッドがコールバックとして登録
    - オートロード実行時に loadClass()がコールバックとされ、$classにクラス名が渡される
    - $dirsプロパティに格納されたパスを1つずつ取り出して、クラスファイルのパスを作成
    - それぞれのパスが読み込み可能であればrequireで読み込む
*/

require 'core/ClassLoader.php';

$ClassLoader = new ClassLoader();

$ClassLoader->regDirectory(dirname(__FILE__) . '/core'); // coreディレクトリを登録

$ClassLoader->regDirectory(dirname(__FILE__) . '/models'); // models ディレクトリを登録

$ClassLoader->register(); // 上記ディレクトリをオートロード対象に登録