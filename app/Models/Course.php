<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {
	use SoftDeletes;

	protected $dates = ['deleted_at'];	// for soft deletes
	protected $fillable = ['course_name', 'course_code', 'description', 'is_active'];	// fields that can be mass assigned
	protected $hidden = ['created_at', 'updated_at', 'deleted_at'];	//	array of fields that are to be ignored i.e. not pulled from the database
	protected $table = 'courses';

}
