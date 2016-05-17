<?php
	
	class Category
	{
		private $id;
		private $logoUrl;
		private $name;
		private $description;
		
		function __construct($id, $logoUrl, $name, $description)
		{
			$this->id = $id;
			$this->logoUrl = $logoUrl;
			$this->name = $name;
			$this->description = $description;
		}
		
		public function setLogoUrl($logoUrl)
		{
			$this->logoUrl = $logoUrl;
			//setCategory($this); //??
		}
		
		public function setName($name)
		{
			$this->name = $name;
			//setCategory($this); //??
		}
		
		public function setDescription($description)
		{
			$this->description = $description;
			//setCategory($this); //??
		}
		
		public function getLogoUrl()
		{
			return $this->logoUrl;
		}
		
		public function getName()
		{
			return $this->name;
		}
		
		public function getDescription()
		{
			return $this->description;
		}
	}
?>