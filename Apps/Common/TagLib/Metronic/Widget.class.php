<?php
namespace Common\TagLib\Metronic;
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


        if ($title) $caption = '<span class="caption">'.$title.'</span>';



        $actions_tpl = '';
        if ($actions) {
            $acs_arr = explode(',', $actions);
            foreach ($acs_arr as $k) {
                $actions_tpl .= $_actions[$k];
            }
            if ($actions_tpl) {
                $actions_tpl = '<div class="portlet-buttons">'.$actions_tpl.'</div>';
            }
        }

        // $actions_tpl = $this->tpl->parse($actions_tpl);


        $_cls = 'portlet box blue-hoki';
        if ($cls) $_cls .= ' '.$cls;

        $_bdcls = 'portlet-body';
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

        $_hdcls = 'portlet-title ';
        if ($hdcls) $_hdcls = $hdcls;
        if ($hd) {
            $hd_str = '<div class="'.$_hdcls.'">
                        '.$icon.$caption.$actions_tpl.'
                    </div>';
        }
        $str = '<div class="'.$_col.'">
                    <div class="'.$_cls.'">
                        '.$hd_str.'
                        <div class="'.$_bdcls.'">
                            '.$content.'
                        </div>
                    </div>
                </div>';
        return $str;
    }


    public function _action($attr,$content){
        extract($attr);

        $content = $this->tpl->parse($content);
        if($id) $_id = "id='".$id."'";
        if ($content) {
            $str = '<div '.$_id.' class="actions">'.$content.'</div>';
        }
        return $str;
    }
}
