<?php
namespace Common\TagLib\Smart;
use Think\Template\TagLib;
defined('THINK_PATH') or exit();
class Widget extends TagLib {
    protected $tags = array(
        'show' => array('attr' => 'col,actions,title,icon,bg,cls,hdcls,bdcls','level'=>5,'alias'=>'iterate'),
        'action' => array('attr' => 'col,actions,title,icon,bg,cls,hdcls,bdcls','level'=>5,'alias'=>'iterate'),
    );

    public function _show($attr,$content) {
        extract($attr);

        $_col = "col-md-6 col-sm-6 col-xs-12 col-lg-6";
        if ($col) $_col = 'col-md-'.$col.' col-sm-'.$col.' col-xs-'.$col.' col-lg-'.$col;


        if ($title) $caption = '<h2>'.$title.'</h2>';



        $actions_tpl = '';

        // $actions_tpl = $this->tpl->parse($actions_tpl);


        $_cls = ' jarviswidget jarviswidget-color-green ';
        if ($cls) $_cls .= ' '.$cls;

        $_bdcls = 'widget-body';
        if ($bdcls) $_bdcls .= ' '.$bdcls;

        $regAction   = '/<Widget:action.*?>(.*?)<\/Widget:action>/is';
        $actions_tpl = '';
        if (preg_match_all($regAction,$content,$matches)) {
            // $content = preg_replace($regAction,"", $content);
            $v = $matches[0];
            for ($i=0; $i < count($v); $i++) {
                $actions_tpl .= $this->tpl->parse($v[$i]);
                // $content = preg_replace($v[$i],"", $content);
                $content = str_replace($v[$i],"", $content);
            }
        }

        $content = $this->tpl->parse($content);
        $hd = $icon.$caption.$actions_tpl;

        $_hdcls = ' ';
        if ($hdcls) $_hdcls = $hdcls;
        if ($hd) {
            $hd_str = '<header class="'.$_hdcls.'">
                        '.$icon.$caption.$actions_tpl.'
                    </header>';
        }
        $str = '<article class="'.$_col.'">
                    <div id="wid-id-1" data-widget-editbutton="false" class="'.$_cls.'">
                        '.$hd_str.'
                        <div><div class="'.$_bdcls.'">
                            '.$content.'
                        </div>
                        </div>
                    </div>
                </article>';
        return $str;
    }

    public function _action($attr,$content){
        extract($attr);
        if($id) $_id = 'id="'.$id.'"';
        $content = $this->tpl->parse($content);
        if ($content) {
            $str = '<div '.$_id.' role="menu" class="widget-toolbar">'.$content.'</div>';
        }
        return $str;
    }
}
