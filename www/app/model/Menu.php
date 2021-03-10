<?php

namespace model;

use core\Model;

class Menu extends Model{

    //获取菜单链接方法
    public static function GetMenuUrl($slug,$header = false){
        if(!$header){
            $slug = json_decode($slug)[0];
        }
        return HOME_URL . $slug;
    }

    //获取菜单标题放方法
    public static function GetMenuTitle($slug,$header = false){
        if(!$header){
            $slug = json_decode($slug)[0];
        }
        $sql = 'select * from pink_menu where slug = \'' . $slug . '\';';
        if($name = self::SqlQuery($sql)){
            return $name['name'];
        }
    }

    //获取菜单图标方法
    public static function GetMenuIcon($slug,$header = false){
        if(!$header){
            $slug = json_decode($slug)[0];
        }
        $sql = 'select * from pink_menu where slug = \'' . $slug . '\';';
        if($icon = self::SqlQuery($sql)){
            return $icon['icon'];
        }
    }

    //获取菜单信息放方法
    public static function GetMenuMeta(){
        $sql = 'select * from pink_menu;';
        return self::SqlQuery($sql,1);
    }

    //构造二级目录数组
    private static $list = array();
    public static function noLimitCategory($categories,$parent_slug = '',$level = 0,$parentid = 0){
        //遍历数组：找出当前符合指定层次的分类
        foreach($categories as $cat){
            if($cat['parent'] == $parent_slug){
                if($level){
                    self::$list[$parentid]['child'][$cat['ID']] = $cat;
                }else{
                    self::$list[$cat['ID']] = $cat;
                }
                self::noLimitCategory($categories,$cat['slug'],$level+1,$cat['ID']);
            }
        }

        return self::$list;
    }

    //获取所有分类信息
    public static function getAllCategories(){
        //获取所有分类信息：根据排序降序排序（数值越大，排序越高）
        $categories = self::GetMenuMeta();

        //进行无限极处理
        return self::noLimitCategory($categories);
    }

}

?>