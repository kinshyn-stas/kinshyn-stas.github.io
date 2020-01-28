<?php
class ModelSitemapSitemap extends Model {
    public function getSitemapProductsData() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product LEFT JOIN " . DB_PREFIX . "url_alias ON " . DB_PREFIX . "url_alias.query=CONCAT('product_id=', " . DB_PREFIX . "product.product_id) WHERE " . DB_PREFIX . "product.status = 1");
        return $query->rows;
    }

    public function getSitemapCategoriesData() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category LEFT JOIN " . DB_PREFIX . "url_alias ON " . DB_PREFIX . "url_alias.query=CONCAT('category_id=', " . DB_PREFIX . "category.category_id)");
        $categories = $query->rows;
        foreach($categories as $k=>$category){
            if($category['parent_id'] != 0){
                $parent_id = $category['parent_id'];
                $query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "category LEFT JOIN " . DB_PREFIX . "url_alias ON " . DB_PREFIX . "url_alias.query=CONCAT('category_id=', " . DB_PREFIX . "category.category_id) where " . DB_PREFIX . "url_alias.query=CONCAT('category_id=', $parent_id)");
                $query = $query->row;
                $keyword = $query['keyword'].'/'.$category['keyword'];
                $categories[$k]['keyword'] = $keyword;
            }
        }
        return $categories;
    }

    public function getSitemapInformationData() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information LEFT JOIN " . DB_PREFIX . "url_alias ON " . DB_PREFIX . "url_alias.query=CONCAT('information_id=', " . DB_PREFIX . "information.information_id)");
        return $query->rows;
    }

}