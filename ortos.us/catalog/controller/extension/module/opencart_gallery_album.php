<?php
class ControllerExtensionModuleOpencartGalleryAlbum extends Controller {
	public function index() {
		$setting = $this->config->get('opencart_gallery_album_module');
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/opencart_gallery.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/opencart_gallery.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/opencart_gallery.css');
		}

		$data['og_title_font_weight'] = $this->config->get('og_title_font_weight');
		$data['title_size'] = $this->config->get('og_title_size');

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

		$this->load->language('extension/module/opencart_gallery_album');
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['button_cart'] = $this->language->get('button_cart');
				
		$this->load->model('gallery/album');
		
		$this->load->model('tool/image');
		
		$data['albums'] = array();

		if($setting['apr'] == 1) {
			$data['apr'] = 'col-lg-12 col-md-12 col-sm-12';
		} else if($setting['apr'] == 2) {
			$data['apr'] = 'col-lg-6 col-md-6 col-sm-6';
		} else if($setting['apr'] == 3) {
			$data['apr'] = 'col-lg-4 col-md-4 col-sm-6';
		} else if($setting['apr'] == 4) {
			$data['apr'] = 'col-lg-3 col-md-3 col-sm-6';
		} else if($setting['apr'] == 6) {
			$data['apr'] = 'col-lg-2 col-md-2 col-sm-6';
		}

		$data['as'] = $setting['as'];

		$data['og_album_image_type'] = $this->config->get('og_album_image_type');

		if($data['og_album_image_type'] == 0) {
			if($setting['as'] == 1) {
				$image_width = 120;
				$image_height = 90;
				$data['mheight'] = '165px';
			} else if ($setting['as'] == 2) {
				$image_width = 160;
				$image_height = 120;
				$data['mheight'] = '195px';
			} else if ($setting['as'] == 3) { 
				$image_width = 200;
				$image_height = 150;
				$data['mheight'] = '225px';
			}
		} else {
			if($setting['as'] == 1) {
				$image_width = 120;
				$image_height = 120;
				$data['mheight'] = '195px';
			} else if ($setting['as'] == 2) {
				$image_width = 160;
				$image_height = 160;
				$data['mheight'] = '235px';
			} else if ($setting['as'] == 3) { 
				$image_width = 200;
				$image_height = 200;
				$data['mheight'] = '275px';
			}
		}	
		
		if($setting['sb'] == 6) {

			$albums = explode(',', $this->config->get('opencart_gallery_album_featured'));		

			if (empty($setting['limit'])) {
				$setting['limit'] = 5;
			}

			$albums = array_slice($albums, 0, (int)$setting['limit']);

			foreach ($albums as $album_id) {
				$album_info = $this->model_gallery_album->getAlbum($album_id);
				
				if ($album_info) {
					if ($album_info['image']) {
						$image = $this->model_tool_image->resize($album_info['image'], $image_width, $image_height);
					} else {
						$image = false;
					}
						
					$data['albums'][] = array(
						'album_id'   => $album_info['album_id'],
						'thumb'   	 => $image,
						'name'    	 => $album_info['name'],
						'href'    	 => $this->url->link('gallery/album', 'album_id=' . $album_info['album_id'])
					);
				}
			}

		} else {

			if($setting['sb'] == 1) {
				$sort = 'a.date_added';
				$order = 'DESC';
			} else if($setting['sb'] == 2) {
				$sort = 'a.viewed';
				$order = 'DESC';
			} else if($setting['sb'] == 4) {
				$sort = 'a.sort_order';
				$order = 'DESC';
			} else if($setting['sb'] == 5) {
				$sort = 'a.name';
				$order = 'ASC';
			}	

			$data_album = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => 0,
				'limit' => $setting['limit']
			);

			$results = $this->model_gallery_album->getAlbums($data_album);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
				} else {
					$image = false;
				}
				
				$data['albums'][] = array(
					'album_id'   => $result['album_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'href'    	 => $this->url->link('gallery/album', 'album_id=' . $result['album_id']),
				);
			}

		}
		

		if ($data['albums']) {
			
			return $this->load->view('extension/module/opencart_gallery_album', $data);
			
		}
	}
}
?>