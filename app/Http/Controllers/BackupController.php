<?php

namespace App\Http\Controllers;


use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Foundation\Application;

class BackupController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
	}

	/**
	 * @return Factory|View
	 */
	public function index() {
		$files = Storage::files('public/Laravel');
		$urls = [];
		foreach($files as $file) {
			$urls[$file] = Storage::url($file);
		}
		return view('administrator/backup', compact('urls'));
	}

	/**
	 * @param string $sqlFile
	 * @return array
	 */
	private function loadSQL(string $sqlFile): array {
		$commands = [];
		if($sqlFile != "") {
			$fileReference = fopen($sqlFile, "r");
			if($fileReference) {
				$creationLines = [];
				$index = 0;
				while(!feof($fileReference)) {
					$line = str_replace("\n", "", fgets($fileReference));
					/*need to verify if is a comment*/
					$creationLines [$index] = $line;
					$index += 1;
				}
				fclose($fileReference);
				$index = 0;
				$tempCommand = "";
				foreach($creationLines as $value) {
					$tempCommand = $tempCommand . $value . " ";
					$size = strlen($value);
					if($size > 0) {
						if(count(explode(";", $value)) == 2) {
							$commands [$index] = $tempCommand;
							$tempCommand = "";
							$index += 1;
						}
					}
				}
			}
		}
		return $commands;
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse|
	 */
	public function importBackup(Request $request): RedirectResponse {
		$commands = $this->loadSQL(
			$request->file('backup_database')
			        ->getRealPath()
		);
		foreach($commands as $value) {
			//DB::statement($value);
			DB::connection()
			  ->getPdo()
			  ->exec($value);
		}
		return redirect("/backup");
	}

	/**
	 * @return Application|Factory|RedirectResponse|Redirector|View
	 */
	public function generateBackup() {
		Artisan::call("backup:run", ['--only-db' => true]);
		return redirect("/backup");
	}

}
