<?php
class ControllerStartupSeoUrl extends Controller {



                            public function getCategories($product_id) {
                                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

                                    return $query->rows;
                            }

                            public function getDataWhisPath(&$data) {
                                if(!$this->config->get('seourlgenerator_canonical_products')){
                                    return;
                                }
                                foreach ($data as $key => $value) {
                                    if (isset($data['route'])){
                                        if (($data['route'] == 'product/product' && $key == 'product_id')){
                                            $allCategories = $this->getAllCategories();
                                            $getCategories = $this->getCategories($value);
                                            $categories = array();
                                            if($getCategories){
                                                $path = '';
                                                $main_path = '';
                                                foreach ($getCategories as $category) {

                                                    if($this->config->get('seourlgenerator_select_main_category')){

                                                        $main_path = $this->getCategoriesMainPath($value,$allCategories);

                                                    }

                                                    if($main_path){

                                                        $path = $main_path;

                                                    }else{

                                                        $check_path = $this->getCategoriesPath($allCategories, $category['category_id']);

                                                        if( mb_strlen($check_path)  >   mb_strlen($path) ){
                                                            $path = $check_path;
                                                        }

                                                    }
                                                }
                                            }
                                            if(isset($path) && $path){
                                                if(isset($data['manufacturer_id'])){
                                                    unset($data['manufacturer_id']);
                                                }
                                                $data['path'] = $path;
                                            }
                                        }
                                    }
                                }
                                ksort($data);

                            }

                            public function getCategoriesMainPath($product_id,$categories) {

                                $main_path = '';

                                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND main_category=1");

                                if($query->row){

                                    $main_path = $this->getCategoriesPath($categories, $query->row['category_id']);

                                }

                                return $main_path;

                            }

                            public function getAllCategories() {
                                $sql = "SELECT cd.name, c.category_id, c.parent_id FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' AND c.sort_order <> '-1'";
                                $query = $this->db->query($sql);
                                $categories = array();
                                if($query->rows){
                                    foreach ($query->rows as $category) {
                                        $parent_id = (int)$category['parent_id'];
                                        $category_id = (int)$category['category_id'];
                                        $name = $category['name'];
                                        if($parent_id > 0) {
                                            $categories[$category_id] = array(
                                                    'id'=>$category_id,
                                                    'parentId'=>$parent_id,
                                                    'name'=>$name
                                            );
                                        }else{
                                            $categories[$category_id] = array(
                                                'id'=>$category_id,
                                                'name'=>$name
                                            );
                                        }
                                    }
                                }
                                return $categories;
                            }

                            protected function getCategoriesPath($categories,$category_id,$old_path = '') {
                                if (isset($categories[$category_id])) {
                                    if (!$old_path) {
                                        $new_path = $categories[$category_id]['id'];
                                    } else {
                                        $new_path = $categories[$category_id]['id'].'_'.$old_path;
                                    }
                                    if (isset($categories[$category_id]['parentId'])) {
                                        return $this->getCategoriesPath($categories,$categories[$category_id]['parentId'], $new_path);
                                    } else {
                                        return $new_path;
                                    }
                                }
                            }

                            protected function redirectOnUrlWhisPath($route) {

                                if(!$this->config->get('seourlgenerator_canonical_products')){
                                    return;
                                }

                                $parts = explode('/', $route);

                                foreach ($parts as $part) {
                                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

                                        if ($query->num_rows) {
                                                $url = explode('=', $query->row['query']);
         if ($url[0] == 'news_id') {
            $this->request->get['news_id'] = $url[1];
          }
/*Opencart Gallery*/
                    if ($url[0] == 'album_id') {
                        $this->request->get['album_id'] = $url[1];
                    }
                    if ($url[0] == 'video_id') {
                        $this->request->get['video_id'] = $url[1];
                    }
                    /*Opencart Gallery*/

                                                if ($url[0] == 'product_id') {
                                                    $link = HTTP_SERVER.'index.php?route=product/product&product_id='.$url[1];
                                                    $seo_url = $this->rewrite($link);
                                                    $seo_url = $this->getSeoUrlPart($seo_url);
                                                    if($route!=$seo_url){
                                                        $this->response->redirect(HTTP_SERVER.$seo_url,301);
                                                    }
                                                }
                                        }
                                }

                            }
                            protected function getSeoUrlPart($seo_url) {
                                $seo_url = str_replace(HTTP_SERVER, '', $seo_url);
                                $parts = explode('/', $seo_url);
                                $seo_url = implode('/', $parts);
                                return $seo_url;
                            }



	public function index() {
		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL
		if (isset($this->request->get['_route_'])) {


                        $this->redirectOnUrlWhisPath($this->request->get['_route_']);



			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}

			foreach ($parts as $part) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");

				if ($query->num_rows) {
					$url = explode('=', $query->row['query']);
         if ($url[0] == 'news_id') {
            $this->request->get['news_id'] = $url[1];
          }
/*Opencart Gallery*/
                    if ($url[0] == 'album_id') {
                        $this->request->get['album_id'] = $url[1];
                    }
                    if ($url[0] == 'video_id') {
                        $this->request->get['video_id'] = $url[1];
                    }
                    /*Opencart Gallery*/

					if ($url[0] == 'product_id') {
						$this->request->get['product_id'] = $url[1];
					}


        // start: OCdevWizard SMBPP
        if ($url[0] == 'smbpp_post_id') {
          $this->request->get['smbpp_post_id'] = $url[1];
        }

        if ($url[0] == 'smbpp_category_id') {
          if (!isset($this->request->get['smbpp_path'])) {
            $this->request->get['smbpp_path'] = $url[1];
          } else {
            $this->request->get['smbpp_path'] .= '_' . $url[1];
          }
        }
        
        if ($url[0] == 'smbpp_author_id') {
          $this->request->get['smbpp_author_id'] = $url[1];
        }
        // end: OCdevWizard SMBPP
      
					if ($url[0] == 'category_id') {
						if (!isset($this->request->get['path'])) {
							$this->request->get['path'] = $url[1];
						} else {
							$this->request->get['path'] .= '_' . $url[1];
						}
					}

					if ($url[0] == 'manufacturer_id') {
						$this->request->get['manufacturer_id'] = $url[1];
					}

					if ($url[0] == 'information_id') {
						$this->request->get['information_id'] = $url[1];
					}


			if ($url[0] == 'blog_id') {$this->request->get['blog_id'] = $url[1]; }
			if ($url[0] == 'blog_category_id') {
			if (!isset($this->request->get['blogpath'])) {
			$this->request->get['blogpath'] = $url[1];
				} else {
			$this->request->get['blogpath'] .= '_' . $url[1];
			}}
			
					if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'news_id' && $url[0] != 'album_id'&& $url[0] != 'video_id' && $url[0] != 'manufacturer_id' && $url[0] 
			!= 'category_id' && $url[0] != 'blog_category_id' && $url[0] != 'blog_id' && $url[0] 
			 != 'product_id') {
						$this->request->get['route'] = $query->row['query'];
					}
				} else {
					$this->request->get['route'] = 'error/not_found';

					break;
				}
			}

			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product';

			} elseif (isset($this->request->get['blog_id'])&&isset($this->request->get['page'])) {
			$this->request->get['route'] = 'blog/blog/comment';
			} elseif (isset($this->request->get['blog_id'])) {
			$this->request->get['route'] = 'blog/blog';
			} elseif ($this->request->get['_route_'] ==  'blog_home') { 
			$this->request->get['route'] = 'blog/home';
			
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category';

			} elseif (isset($this->request->get['blogpath'])) {
			$this->request->get['route'] = 'blog/category';
			

        // start: OCdevWizard SMBPP
        } elseif (isset($this->request->get['smbpp_post_id'])) {
					$this->request->get['route'] = 'extension/ocdevwizard/smart_blog_pro_plus/post';
				} elseif (isset($this->request->get['smbpp_path'])) {
					$this->request->get['route'] = 'extension/ocdevwizard/smart_blog_pro_plus/category';
				} elseif (isset($this->request->get['smbpp_author_id'])) {
					$this->request->get['route'] = 'extension/ocdevwizard/smart_blog_pro_plus/author';
        // end: OCdevWizard SMBPP
      
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info';
} elseif (isset($this->request->get['album_id'])) {
                $this->request->get['route'] = 'gallery/album';
            } elseif (isset($this->request->get['video_id'])) {
                $this->request->get['route'] = 'gallery/video';
            
				
        } elseif (isset($this->request->get['news_id'])) {
          $this->request->get['route'] = 'information/news/info';
        } elseif (isset($this->request->get['information_id'])) {
        
					$this->request->get['route'] = 'information/information';
				}
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));

		$url = '';

		$data = array();

		parse_str($url_info['query'], $data);


                            $this->getDataWhisPath($data);




		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || ($data['route'] == 'gallery/album' && $key == 'album_id') || ($data['route'] == 'gallery/video' && $key == 'video_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') || 
			($data['route'] == 'information/information' && $key == 'information_id') || ($data['route'] == 'information/news/info' && $key == 'news_id') || ($data['route'] == 'blog/blog' && $key == 'blog_id'))
			 {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");

					if ($query->num_rows && $query->row['keyword']) {
						$url .= '/' . $query->row['keyword'];

						unset($data[$key]);
					}

			} elseif ($key == 'blogpath') {
			$blog_categories = explode('_', $value);
			foreach ($blog_categories as $category) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'blog_category_id=" . (int)$category . "'");
			if ($query->num_rows) {
			$url .= '/' . $query->row['keyword'];
			} else {
			$url = '';
			break;
			}}
			unset($data[$key]);
			} elseif (isset($data['route']) && $data['route'] ==   'blog/home') {
			$blog_home = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'blog/home'");
			if ($blog_home->num_rows) {
			$url .= '/' . $blog_home->row['keyword'];
			} else {
			$url = '';
			}
			
				} elseif ($key == 'path' || $key == 'npath') {
					$categories = explode('_', $value);

					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");

						if ($query->num_rows && $query->row['keyword']) {
							$url .= '/' . $query->row['keyword'];
						} else {
							$url = '';

							break;
						}
					}

					unset($data[$key]);
				}
			}
		}

		if ($url) {
			unset($data['route']);

			$query = '';

			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((is_array($value) ? http_build_query($value) : (string)$value));
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}

			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}
