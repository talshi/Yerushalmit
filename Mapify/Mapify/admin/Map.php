<?php
	class Map
	{
		private $width;
		private $height;
		private $url; //url of image
		
		function __construct($width, $height, $url) 
		{
			$this->width = $width;
			$this->height = $height;
			$this->url = $url;
		}
		
		public function setWidth($width)
		{
            if(is_numeric($width))
            {
                $this->width = $width;
			    //setMap($this); //method in DBController ??      
            }
		
		}
		
		public function setHeight($height)
		{
            if(is_numeric($height))
		    {
			    $this->height = $height;
			    //setMap($this); //??  
		    }

		}
		
		public function setUrl($url)
		{
			$this->url = $url;
			//setMap($this); //??
		}
		
		public function getWidth()
		{
			return $this->width;
		}
		
		public function getHeight()
		{
			return $this->height;
		}
		public function getUrl()
		{
			return $this->url;
		}
		
	}
?>
