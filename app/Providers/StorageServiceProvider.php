<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {

        $this->app->bind(	// binding the School model repositories
			'App\Libs\Platform\Storage\School\SchoolRepository',
			'App\Libs\Platform\Storage\School\EloquentSchoolRepository'
		);

		$this->app->bind(	// binding the Course model repositories
			'App\Libs\Platform\Storage\Course\CourseRepository',
			'App\Libs\Platform\Storage\Course\EloquentCourseRepository'
		);
	}
}
