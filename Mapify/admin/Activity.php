<?php

	class Activity
	{
		private $id;
		private $name;
		private $date;
		private $description;
		private $activityLocation; //place of the activity 
		private $location; //array with 2 coordination - place on image
		private $showOnMap;
		private $category;
	
	
	    function __construct($id, $name, $date, $description, $activityLocation, $x, $y, $category)
	    {
		    $this->id = $id;
		    $this->name = $name;
		    $this->date = new DateTime($date); //new DateTime('02/31/2011');
		    $this->description = $description;
		    $this->activityLocation = $activityLocation;
		    $this->location = array($x,$y);
		    $this->category = clone $category;
	    }
	
	    public function setName($name)
	    {
		    $this->name = $name;
		    //setActivity($this);//??
	    }
	
	    public function setDate($date)
	    {
		    list($y, $m, $d) = explode("/", $date);
		    if(checkdate($m, $d, $y))
		    {
			    $this->date = $date;
			    //setActivity($this);//??
		    } 		
	    }
	
	    public function setDescription($description)
	    {
		    $this->description = $description;
		    //setActivity($this);//??
	    }
	
	    public function setActivityLocation($activityLocation)
	    {
		    $this->activityLocation = $activityLocation;
		    //setActivity($this);
	    }
	
	    public function setLocation($x,$y)
	    {
		    if(is_numeric($x) and is_numeric($y))
		    {
			    $this->location = array($x,$y);
			    //setActivity($this);
		    }
	    }
	
	    public function setShowOnMap($showOnMap)
	    {
		    if(is_bool($showOnMap) === true)
			    $this->showOnMap = $showOnMap;
		    setActivity($this);	
	    }
	
	    public function getId()
	    {
		    return $this->id;
	    }
	
	    public function getName()
	    {
		    return $this->name;
	    }
	
	    public function getDate()
	    {
		    return $this->date;
	    }
	
	    public function getDescription()
	    {
		    return $this->description;
	    }
	
	    public function getActivityLocation()
	    {
		    return $this->activityLocation;
	    }
	
	    public function getLocation()
	    {
		    return $this->location;
	    }
	
	    public function getCategory()
	    {
		    return $this->category;
	    }	
    }
?>