<?php

class FileUploader
{
	private $uploadFile;
	private $name;
	private $tmp_name;
	private $type;
	private $size;
	private $error;
	private $allowedTypes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

	public function __construct($uploadDir="./uploads/")
	{
		if (!is_dir($uploadDir)) {
			throw new Exception("Invalid upload directory.");
		}

		if(!count($_FILES)) {
			throw new Exception("Invalid number of file upload parameters");
		}

		foreach ($_FILES['file'] as $key => $value) {
			$this->{$key} = $value;
		}

		if (!in_array($this->type, $this->allowedTypes)) {
			throw new Exception("Invalid MIME type of target file");
		}

		$this->uploadFile = $uploadDir.basename($this->name);
	}

	public function upload()
	{
		if (move_uploaded_file($this->tmp_name, $this->uploadFile)) {
			return $this->uploadFile;
		}
	}
}

?>