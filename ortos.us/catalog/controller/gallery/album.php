<?php 
class ControllerGalleryAlbum extends Controller {  
	public function index() { 
		$this->load->language('gallery/album');

		$this->load->model('gallery/album');

		$this->load->model('tool/image'); 
		
		$data['heading_title_size'] = $this->config->get('og_heading_title_size');
				
		$heading_title_font = $this->config->get('og_heading_title_font');
		
		if($heading_title_font == 1) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Open+Sans:400,800');
			$data['heading_title_font'] = "'Open Sans', sans-serif";
		} else if ($heading_title_font == 2) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Josefin+Slab:400,700');
			$data['heading_title_font'] = "'Josefin Slab', serif";	
		} else if ($heading_title_font == 3) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Arvo:400,700');
			$data['heading_title_font'] = "'Arvo', serif";
		} else if ($heading_title_font == 6) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Ubuntu:400,700');
			$data['heading_title_font'] = "'Ubuntu', sans-serif";
		} else if ($heading_title_font == 7) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=PT+Sans:400,700');
			$data['heading_title_font'] = "'PT Sans', sans-serif";
		} else if ($heading_title_font == 8) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700');
			$data['heading_title_font'] = "'Old Standard TT', serif";
		} else if ($heading_title_font == 9) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
			$data['heading_title_font'] = "'Droid Sans', sans-serif";
		} else if ($heading_title_font == 10) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Oswald:400,700');
			$data['heading_title_font'] = "'Oswald', sans-serif";
		} else if ($heading_title_font == 11) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Lato:400,700');
			$data['heading_title_font'] = "'Lato', sans-serif";
		} else if ($heading_title_font == 12) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Lobster+Two:400,700');
			$data['heading_title_font'] = "'Lobster Two', cursive";
		} else if ($heading_title_font == 13) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Pacifico');
			$data['heading_title_font'] = "'Pacifico', cursive";
		} else if ($heading_title_font == 14) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Oleo+Script:400,700');
			$data['heading_title_font'] = "'Oleo Script', cursive";
		}else if ($heading_title_font == 21) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Montserrat:400,700');
			$data['heading_title_font'] = "'Montserrat', sans-serif";
		} else if ($heading_title_font == 24) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Inconsolata:400,700');
			$data['heading_title_font'] = "'Inconsolata'";
		} else if ($heading_title_font == 25) {
			$this->document->addStyle('http://fonts.googleapis.com/css?family=Roboto:400,700');
			$data['heading_title_font'] = "'Roboto', sans-serif";
		} else if ($heading_title_font == 27) {
			$data['heading_title_font'] = "Arial";
		} else if ($heading_title_font == 28) {
			$data['heading_title_font'] = "'Times New Roman'";
		} else if ($heading_title_font == 29) {
			$data['heading_title_font'] = "'Tahoma'";
		} else if ($heading_title_font == 30) {
			$data['heading_title_font'] = "'Verdana'";
		} 

		$data['heading_title_line'] = $this->config->get('og_heading_title_line');

		$og_album_per_row = $this->config->get('og_album_per_row');

		if($og_album_per_row == 1) {
			$data['apr'] = 'col-lg-12 col-md-12 col-sm-12';
		} else if($og_album_per_row == 2) {
			$data['apr'] = 'col-lg-6 col-md-6 col-sm-6';
		} else if($og_album_per_row == 3) {
			$data['apr'] = 'col-lg-4 col-md-4 col-sm-6';
		} else if($og_album_per_row == 4) {
			$data['apr'] = 'col-lg-3 col-md-3 col-sm-6';
		} else if($og_album_per_row == 6) {
			$data['apr'] = 'col-lg-2 col-md-2 col-sm-6';
		}


		$data['og_album_size'] = $this->config->get('og_album_size');

		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/opencart_gallery.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/opencart_gallery.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/opencart_gallery.css');
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}	

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('og_album_per_page');
		}

		// Set the last category breadcrumb		
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_gallery_album'),
			'href'      => $this->url->link('gallery/album', $url),
			'separator' => $this->language->get('text_separator')
		);

		if (isset($this->request->get['album_id'])) {
			$album_id = (int)$this->request->get['album_id'];
		} else {
			$album_id = 0;
		}

		$album_info = $this->model_gallery_album->getAlbum($album_id);

		if ($album_info) {
			$this->document->setTitle($album_info['name']);
			$this->document->setDescription($album_info['meta_description']);
			$this->document->setKeywords($album_info['meta_keyword']);

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');


			$data['heading_title'] = $album_info['name'];
			$data['text_empty'] = $this->language->get('text_empty');
			
			$data['breadcrumbs'][] = array(
				'text'      => $album_info['name'],
				'href'      => $this->url->link('gallery/album', 'album_id=' . $this->request->get['album_id'] . $url),
				'separator' => $this->language->get('text_separator')
			);

			$data['album_id'] = $this->request->get['album_id'];

			$data['og_album_image_type'] = $this->config->get('og_album_image_type');

			if($data['og_album_image_type']) {
				$img_height = 270;
				$thumb_height = 270;
			} else {
				$img_height = 170;
				$thumb_height = 170;
			}
			
			$popup_width = $this->config->get('og_image_pu_width');
			$popup_height = $this->config->get('og_image_pu_height');

			$this->load->model('tool/image');

			if ($album_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($album_info['image'], $popup_width , $popup_height);
			} else {
				$data['popup'] = '';
			}

			if ($album_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($album_info['image'], 270, $img_height);
			} else {
				$data['thumb'] = '';
			}

			$data['images'] = array();

			$results = $this->model_gallery_album->getAlbumImages($this->request->get['album_id']);

			foreach ($results as $result) {
				$data['images'][] = array(
					'name'  => $result['name'],
					'popup' => $this->model_tool_image->resize($result['image'], $popup_width , $popup_height),
					'thumb' => $this->model_tool_image->resize($result['image'], 270, $thumb_height),
				);
			}	

			$data['description'] = html_entity_decode($album_info['description'], ENT_QUOTES, 'UTF-8');

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$url = '';


			$data['continue'] = $this->url->link('gallery/album');

			$this->model_gallery_album->updateViewed($this->request->get['album_id']);
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			
			$this->response->setOutput($this->load->view('gallery/album_info', $data));
			

		} else {

			$url = '';

			if (isset($this->request->get['album_id'])) {
				$url .= '&album_id=' . $this->request->get['album_id'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			if(isset($this->request->get['album_id'])) {					

				$data['breadcrumbs'][] = array(
					'text'      => $this->language->get('text_error'),
					'href'      => $this->url->link('gallery/album', $url),
					'separator' => $this->language->get('text_separator')
				);

				$this->document->setTitle($this->language->get('text_error'));

				$data['heading_title'] = $this->language->get('text_error');
				$data['text_error'] = $this->language->get('text_error');
				$data['text_empty'] = $this->language->get('text_empty');


				//$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');

				
				$this->response->setOutput($this->load->view('error/not_found', $data));
				
				
			} else {

				$this->document->setTitle($this->language->get('heading_title'));

				$data['heading_title'] = $this->language->get('heading_title');
				$data['text_empty'] = $this->language->get('text_empty');

				if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else { 
					$page = 1;
				}	

				if (isset($this->request->get['limit'])) {
					$limit = $this->request->get['limit'];
				} else {
					$limit = $this->config->get('og_album_per_page');
				}


				$url = '';

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['title_size'] = $this->config->get('og_title_size');
				$data['og_title_font_weight'] = $this->config->get('og_title_font_weight');

				$title_font = $this->config->get('og_title_font');
				
				if($title_font == 1) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Open+Sans:400,800');
					$data['title_font'] = "'Open Sans', sans-serif";
				} else if ($title_font == 2) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Josefin+Slab:400,700');
					$data['title_font'] = "'Josefin Slab', serif";	
				} else if ($title_font == 3) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Arvo:400,700');
					$data['title_font'] = "'Arvo', serif";
				} else if ($title_font == 6) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Ubuntu:400,700');
					$data['title_font'] = "'Ubuntu', sans-serif";
				} else if ($title_font == 7) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=PT+Sans:400,700');
					$data['title_font'] = "'PT Sans', sans-serif";
				} else if ($title_font == 8) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700');
					$data['title_font'] = "'Old Standard TT', serif";
				} else if ($title_font == 9) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
					$data['title_font'] = "'Droid Sans', sans-serif";
				} else if ($title_font == 10) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Oswald:400,700');
					$data['title_font'] = "'Oswald', sans-serif";
				} else if ($title_font == 11) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Lato:400,700');
					$data['title_font'] = "'Lato', sans-serif";
				} else if ($title_font == 12) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Lobster+Two:400,700');
					$data['title_font'] = "'Lobster Two', cursive";
				} else if ($title_font == 13) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Pacifico');
					$data['title_font'] = "'Pacifico', cursive";
				} else if ($title_font == 14) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Oleo+Script:400,700');
					$data['title_font'] = "'Oleo Script', cursive";
				}else if ($title_font == 21) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Montserrat:400,700');
					$data['title_font'] = "'Montserrat', sans-serif";
				} else if ($title_font == 24) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Inconsolata:400,700');
					$data['title_font'] = "'Inconsolata'";
				} else if ($title_font == 25) {
					$this->document->addStyle('http://fonts.googleapis.com/css?family=Roboto:400,700');
					$data['title_font'] = "'Roboto', sans-serif";
				} else if ($title_font == 27) {
					$data['title_font'] = "Arial";
				} else if ($title_font == 28) {
					$data['title_font'] = "'Times New Roman'";
				} else if ($title_font == 29) {
					$data['title_font'] = "'Tahoma'";
				} else if ($title_font == 30) {
					$data['title_font'] = "'Verdana'";
				} 

				$data['albums'] = array();

				$data_albums = array(
					'start'              => ($page - 1) * $limit,
					'limit'              => $limit
				);

				$data['og_album_height'] = $this->config->get('og_album_height');

				$data['og_album_image_type'] = $this->config->get('og_album_image_type');

				if($data['og_album_size'] == 1) {
					$img_width = 120;
					if($data['og_album_image_type']) {
						$img_height = 120;
					} else {
						$img_height = 90;
					}
				} else if ($data['og_album_size'] == 2) {
					$img_width = 160;
					if($data['og_album_image_type']) {
						$img_height = 160;
					} else {
						$img_height = 120;
					}
				} else if ($data['og_album_size'] == 3) {
					$img_width = 200;
					if($data['og_album_image_type']) {
						$img_height = 200;
					} else {
						$img_height = 150;
					}
				} 

				$album_total = $this->model_gallery_album->getTotalAlbums($data_albums); 

				$results = $this->model_gallery_album->getAlbums($data_albums);

				foreach ($results as $result) {
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $img_width, $img_height);
					} else {
						$image = false;
					}

					$data['albums'][] = array(
						'album_id'  => $result['album_id'],
						'thumb'       => $image,
						'name'        => $result['name'],
						'href'        => $this->url->link('gallery/album', '&album_id=' . $result['album_id'] )
					);
				}

				$url = '';

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}


				$url = '';


				$data['limits'] = array();

				$limits = array_unique(array($this->config->get('og_album_per_page'), $this->config->get('og_album_per_page')*2, $this->config->get('og_album_per_page')*4, $this->config->get('og_album_per_page')*8, $this->config->get('og_album_per_page')*16 ));

				sort($limits);

				foreach($limits as $value){
					$data['limits'][] = array(
						'text'  => $value,
						'value' => $value,
						'href'  => $this->url->link('gallery/album', $url . '&limit=' . $value)
					);
				}

				$url = '';

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$pagination = new Pagination();
				$pagination->total = $album_total;
				$pagination->page = $page;
				$pagination->limit =  $limit;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('gallery/album', $url . '&page={page}');

				$data['pagination'] = $pagination->render();
				$data['results'] = sprintf($this->language->get('text_pagination'), ($album_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($album_total - $limit)) ? $album_total : ((($page - 1) * $limit) + $limit), $album_total, ceil($album_total / $limit));

				$data['limit'] = $limit;

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				
				$this->response->setOutput($this->load->view('gallery/album', $data));


			}
		}
	}

}
?>