<?php

namespace Core;

class View {

    function __construct() {
    }

    public static function render($view, $data = []){

        extract($data);
        
        $file = '../Resource/View/' . $view . '.php';
        
        include_once 'Functions.php';

        $content = file_get_contents($file);

        $content = preg_replace('/{{{\s*(.+?)\s*}}}/', '<?php parseInterpolation($1) ?>', $content);

        $content = preg_replace('/@if\(\s*(.+?)\s*\)/', '<?php if($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\(\s*(.+?)\s*\)/', '<?php foreach($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);
        $content = preg_replace('/@for\(\s*(.+?)\s*\)/', '<?php for($1): ?>', $content);
        $content = preg_replace('/@endfor/', '<?php endfor; ?>', $content);

        preg_match_all('/@section\(\'(.*)\'\)/', $content, $arr);
        
        $sections = preg_replace('/@section\(\'(.*)\'\)/', '$1', $arr[0]);

        $section_data = [];
        foreach($sections as $section){
            $section_data[$section] = get_string_between($content, "@section('$section')", "@endsection('$section')");
            $content = str_replace("@section('".$section."')", "", $content);
            $content = str_replace($section_data[$section], "", $content);
            $content = str_replace("@endsection('".$section."')", "", $content);
        }

        preg_match_all('/@layout\(\'(.*)\'\)/', $content, $arr);

        $layoutContent = "";

        if(sizeof($arr[1]) > 0){

            $layout = '../Resource/View/' . $arr[1][0] . '.php';

            $layoutContent = file_get_contents($layout);

            $layoutContent = preg_replace_callback('/@section\(\s*(.+?)\s*\)/', function($m) use($section_data){
                $a = str_replace("'", "", $m[1]);
                return isset($section_data[$a]) ? $section_data[$a] : '';
            }, $layoutContent);

        }

        $cacheFile = '../Temp/Cache/' . $view . '.php';
        $dirname = dirname($cacheFile, PATHINFO_DIRNAME);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }

        file_put_contents($cacheFile, $layoutContent);

        include $cacheFile;

    }

}