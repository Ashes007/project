<?php
if (!defined('BASEPATH')) exit('No direct access allowed.');
class MY_Pagination extends CI_Pagination{
	
	var $current_page_nos		= '';
	
	function setFrontendPaginationStyle(&$config){

		
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 	= TRUE;
		
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div class="first">';
		$config['first_tag_close'] = '</div>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div class="last">';
		$config['last_tag_close'] = '</div>';
		
		$config['cur_tag_open'] = '<div class="current" >';
		$config['cur_tag_close'] = '</div>';
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<div class="previous">';
		$config['prev_tag_close'] = '</div>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<div class="next">';
		$config['next_tag_close'] = '</div>';
		
		
	}
	
	function setAdminPaginationStyle(&$config)
	{
	    $config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active" ><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['prev_link'] = '<<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = '>>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
	}
	
	public function setMailPaginationStyle(&$config)
	{
		$config['page_query_string'] 	= FALSE;
		$config['display_pages'] 	= FALSE;
		
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$config['num_tag_open'] = '<div>';
		$config['num_tag_close'] = '</div>';
		
		$config['first_link'] = '';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		
		$config['last_link'] = '';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = ''; 
		
		$config['cur_tag_open'] = '';
		$config['cur_tag_close'] = '';
		
		$config['prev_link'] = '<img src="'.base_url().'images/mail11.png" alt="no img"/>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = '<img src="'.base_url().'/images/mail12.png" alt="no img"/>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
	}
    

    // --------------------------------------------------------------------

    /**
     * Generate the pagination links
     *
     * @access	public
     * @return	string
     */
    function create_links1()
    {
	// If our item count or per-page total is zero there is no need to continue.
	if ($this->total_rows == 0 OR $this->per_page == 0)
	{
		return '';
	}

	// Calculate the total number of pages
	$num_pages = ceil($this->total_rows / $this->per_page);

	// Is there only one page? Hm... nothing more to do here then.
	if ($num_pages == 1)
	{
		return '';
	}

	// Set the base page index for starting page number
	if ($this->use_page_numbers)
	{
		$base_page = 1;
	}
	else
	{
		$base_page = 0;
	}

	// Determine the current page number.
	$CI =& get_instance();

	if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
	{
		if ($CI->input->get($this->query_string_segment) != $base_page)
		{
			$this->cur_page = $CI->input->get($this->query_string_segment);

			// Prep the current page - no funny business!
			$this->cur_page = (int) $this->cur_page;
		}
	}
	else
	{
		/*
		if ($CI->uri->segment($this->uri_segment) != $base_page)
		{
			$this->cur_page = $CI->uri->segment($this->uri_segment);

			// Prep the current page - no funny business!
			$this->cur_page = (int) $this->cur_page;
		}
		*/
		//echo "----".$this->current_page_nos ."----";
		if ($this->current_page_nos != $base_page)
		{
			$this->cur_page = $this->current_page_nos;

			// Prep the current page - no funny business!
			$this->cur_page = (int) $this->cur_page;
		}
		
	}
	
	// Set current page to 1 if using page numbers instead of offset
	if ($this->use_page_numbers AND $this->cur_page == 0)
	{
		$this->cur_page = $base_page;
	}

	$this->num_links = (int)$this->num_links;

	if ($this->num_links < 1)
	{
		show_error('Your number of links must be a positive number.');
	}

	if ( ! is_numeric($this->cur_page))
	{
		$this->cur_page = $base_page;
	}

	// Is the page number beyond the result range?
	// If so we show the last page
	if ($this->use_page_numbers)
	{
		if ($this->cur_page > $num_pages)
		{
			$this->cur_page = $num_pages;
		}
	}
	else
	{
		if ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}
	}

	$uri_page_number = $this->cur_page;
	
	if ( ! $this->use_page_numbers)
	{
		$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
	}

	// Calculate the start and end numbers. These determine
	// which number to start and end the digit links with
	$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
	$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

	// Is pagination being used over GET or POST?  If get, add a per_page query
	// string. If post, add a trailing slash to the base URL if needed
	if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
	{
		$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
	}
	else
	{
		$this->base_url = rtrim($this->base_url, '/') .'/';
	}

	// And here we go...
	$output = '';

	// Render the "First" link
	if  ($this->first_link !== FALSE AND $this->cur_page > ($this->num_links + 1))
	{
		$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
		$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="javascrip:void(0);" class="paginate_class" id="first_link">'.$this->first_link.'</a>'.$this->first_tag_close;
	}

	// Render the "previous" link
	if  ($this->prev_link !== FALSE AND $this->cur_page != 1)
	{
		if ($this->use_page_numbers)
		{
			$i = $uri_page_number - 1;
		}
		else
		{
			$i = $uri_page_number - $this->per_page;
		}

		if ($i == 0 && $this->first_url != '')
		{
			$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="javascrip:void(0);" class="paginate_class" id="prev_link">'.$this->prev_link.'</a>'.$this->prev_tag_close;
		}
		else
		{
			$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
			$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);" class="paginate_class" id="'.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
		}

	}

	// Render the pages
	if ($this->display_pages !== FALSE)
	{
		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++)
		{
			if ($this->use_page_numbers)
			{
				$i = $loop;
			}
			else
			{
				$i = ($loop * $this->per_page) - $this->per_page;
			}

			if ($i >= $base_page)
			{
				if ($this->cur_page == $loop)
				{	//echo "<>".$this->cur_page.'<>';
					//$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					//$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					$output .= $this->cur_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);" class="paginate_class" id="'.$this->cur_page.'">'.$loop.'</a>'.$this->cur_tag_close;
				}
				else
				{
					$n = ($i == $base_page) ? '' : $i;

					if ($n == '' && $this->first_url != '')
					{
						$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);">'.$loop.'</a>'.$this->num_tag_close;
					}
					else
					{
						$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

						$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);" class="paginate_class" id="'.$n.'">'.$loop.'</a>'.$this->num_tag_close;
					}
				}
			}
		}
	}

	// Render the "next" link
	if ($this->next_link !== FALSE AND $this->cur_page < $num_pages)
	{
		if ($this->use_page_numbers)
		{
			$i = $this->cur_page + 1;
		}
		else
		{
			$i = ($this->cur_page * $this->per_page);
		}

		$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);" class="paginate_class" id="'.$i.'">'.$this->next_link.'</a>'.$this->next_tag_close;
	}

	// Render the "Last" link
	if ($this->last_link !== FALSE AND ($this->cur_page + $this->num_links) < $num_pages)
	{
		if ($this->use_page_numbers)
		{
			$i = $num_pages;
		}
		else
		{
			$i = (($num_pages * $this->per_page) - $this->per_page);
		}
		$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="javascript:void(0);" class="paginate_class" id="'.$i.'">'.$this->last_link.'</a>'.$this->last_tag_close;
	}

	// Kill double slashes.  Note: Sometimes we can end up with a double slash
	// in the penultimate link so we'll kill all double slashes.
	$output = preg_replace("#([^:])//+#", "\\1/", $output);

	// Add the wrapper HTML if exists
	$output = $this->full_tag_open.$output.$this->full_tag_close;

	return $output;
    }

}
?>