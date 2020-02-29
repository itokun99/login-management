<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function needAuth(){
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized',
        ], 401);
    }
    
    public function responseSuccess($data = NULL, $msg = 'successfull', $statusCode = 200){
        $res['status'] = true;
        $res['message'] = $msg;
        if($data) $res['data'] = $data;
        return response()->json($res, $statusCode);
    }

    public function responseError($error = NULL, $msg = 'Bad Request', $statusCode = 400){
        $res['status'] = false;
        $res['message'] = $msg;
        if($error) $res['error'] = $error;
        return response()->json($res, $statusCode);
    }

    public function schemaError($message = 'Schema Error') {
        return [
            'status' => FALSE,
            'message' => $message
        ];
    }

    public function schemaSuccess($message = 'Table created') {
        return [
            'status' => TRUE,
            'message' => $message
        ];
    }

    public function createMemberTable($client_id = 12,  $dropIfExist = FALSE) {
        if(!$client_id) return $this->schemaError('client_id is null');
        $member_table = new Schema();
        
        $table_name = "members_$client_id";
        $exist_table = $member_table::hasTable($table_name);

        if(!$dropIfExist && $exist_table) return $this->schemaError('member table is exists');
        if($dropIfExist) $member_table::dropIfExists($table_name);
        
        $member_table::create($table_name, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('nickname', 100)->unique();
            $table->text('pic')->nullable();
            $table->string('password')->nullable();
            $table->text('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('signup_from')->nullable();
            $table->string('social_key')->nullable();
            $table->string('token')->nullable();
            $table->string('forget_token')->nullable();
            $table->timestamp('last_login');
            $table->timestamps();
        });

        $table_was_created = $member_table::hasTable($table_name);
        
        if(!$table_was_created) return $this->schemaError('table not created');

        return $this->schemaSuccess();
    }

    public function createHash($value = NULL) {
        if(!$value) return NULL;
        return Hash::make($value);
    }

    public function checkHash($input = NULL, $hash = NULL) {
        if(!$input || !$hash) return NULL;
        return Hash::check($input, $hash);
    }

    public function validateEmail($value = NULL) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function findOne($model = NULL, $column = NULL, $value = NULL, $status = FALSE) {
        if(!$value || !$column || !$model) return NULL;
        $query = $model::select(['*'])->where($column, $value);
        if($status) $query->where('status', 1);
        return $query->first();
    }
}
