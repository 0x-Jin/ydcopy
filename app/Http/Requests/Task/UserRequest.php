<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Request;

//  422提示：
class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//return false;  //Forbidden 进不来
    }

    /**
     * Get the validation rules that apply to the request.
     * 插入和更新验证的区别怎么区分
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'age'=>'required',
            'height'=>'required|digits_between:10,11',
        ];
    }
    
    //定义出错后的message信息：
    public function messages() {
         return [
            'name.required'=>'姓名不能为空',
            'age.required'=>'年龄不能为空',
            'height.required'=>'身高不能为空',
        ];
    }
    
    //认证失败之后的处理
//    public function failedAuthorization() {
//          exit('非法进入') ;
//        parent::failedAuthorization();
//    }
    
    // woo 改变验证后的默认行为： 变成 ajax
    public function failedValidation( \Illuminate\Contracts\Validation\Validator $validator ) {
        exit(json_encode(array(
            'success' => false,
            'message' => 'There are incorect values in the form!',
            'errors' => $validator->getMessageBag()->toArray()
        )));
    }
    
    
}
