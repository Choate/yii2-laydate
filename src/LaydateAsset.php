<?php
/**
 * Created by PhpStorm.
 * User: Choate
 * Date: 2018/3/24
 * Time: 11:46
 */

namespace choate\yii2\laydate;


use yii\web\AssetBundle;

class LaydateAsset extends AssetBundle
{
    public $sourcePath = '@bower/laydate/dist/';

    public $js = [
        'laydate.js',
    ];
}