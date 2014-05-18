<?php

class ImageController extends BaseController {

	private static function getImagesDirectory() {
		return Config::get('assets.images');
	}
	
	private static function getFilename($id) {
		return self::getImagesDirectory() . "/" . $id . ".gif";
	}
	
	public function getImage($filename) {

		// Append the filename to the path where our images are located
		$path = self::getImagesDirectory() . "/" . $filename;

		// Initialize an instance of Symfony's File class.
		// This is a dependency of Laravel so it is readily available.
		$file = new Symfony\Component\HttpFoundation\File\File($path);

		// Make a new response out of the contents of the file
		// Set the response status code to 200 OK
		$response = Response::make(
			File::get($path), 
			200
		);

		// Modify our output's header.
		// Set the content type to the mime of the file.
		// In the case of a .jpeg this would be image/jpeg
		$response->header(
			'Content-type',
			$file->getMimeType()
		);

		// We return our image here.
		return $response;
	}

	public static function storeImage($id, $uploadedFile) {
		$uploadedFile->move(self::getImagesDirectory(), $id . ".gif");
	}

	public static function storeImage2($id, $path) {
		$filename = self::getFilename($id);
		rename($path, $filename);
	}
	
	public static function zipToGif($uploadedFile) {
		$tmpDir = self::createTempDir('daumenkivy_zip_upload');
		
		// extract ZIP archive
		$zip = new ZipArchive;
		$zip->open($uploadedFile->getPathname());
		Log::debug($tmpDir);
		$zip->extractTo($tmpDir);
		$zip->close();

		// create animated GIF
		$animatedPath = tempnam(sys_get_temp_dir(), "daumenkivy_animated_gif");
		Log::debug($animatedPath);
		// -delay - in 1/100 seconds
		// -loop - 0=infinite
		$command = escapeshellcmd("convert -delay 50 -loop 0 $tmpDir/*.png gif:$animatedPath");
		Log::debug($command);
		$execResult = passthru($command, $returnVar);
		Log::debug($execResult);
		Log::debug($returnVar);
		if ($returnVar > 0) {
			// TODO handle error
		}
		// delete temporary directory
		exec("rm -rf $tmpDir"); // when running on Linux
		exec("rmdir /s /q $tmpDir"); // when running on Windows
		return $animatedPath;
	}

	private static function createTempDir($prefix) {
		$tempfile=tempnam(sys_get_temp_dir(), $prefix);
		if (file_exists($tempfile)) { unlink($tempfile); }
		mkdir($tempfile);
		if (is_dir($tempfile)) { return $tempfile; }
	}
}
