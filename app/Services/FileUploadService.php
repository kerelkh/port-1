<?php

namespace App\Services;

class FileUploadService {
    public static function storeLanding($file) {
        $filename = "landingBanner" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/images', $filename);
        $filepath = '';
        if($path){
            $filepath = "images/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public static function storePortrait($file) {
        $filename = "portrait" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/portrait', $filename);
        $filepath = '';
        if($path){
            $filepath = "portrait/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public static function storeSquare($file) {
        $filename = "square" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/square', $filename);
        $filepath = '';
        if($path){
            $filepath = "square/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public static function storeArticleImage($file) {
        $filename = "article" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/articles', $filename);
        $filepath = '';
        if($path){
            $filepath = "articles/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public static function storePhotoImage($file) {
        $filename = "photo" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/photos', $filename);
        $filepath = '';
        if($path){
            $filepath = "photos/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public static function storeProductImage($file) {
        $filename = "product" . now()->format('ymdhis') . '.'. $file->extension();
        $path = $file->storeAs('public/products', $filename);
        $filepath = '';
        if($path){
            $filepath = "products/" . $filename;

            return $filepath;
        }

        return 0;
    }
}
