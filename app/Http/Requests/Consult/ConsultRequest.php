<?php
//验证要注入的数据
namespace App\Http\Requests\Consult;

use App\Http\Requests\Request;

class ConsultRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'realname'=>'required',
            'tellphone'=>'required|digits_between:10,11',//验证
            'email'=>'required|email',
            'body'=>'required',
            'published_at'=>'date',
            'platform'=>'required',
            'remark'=>'',
            'check_remark'=>''
        ];
    }
    
    /**
     * Get the message if do not pass the rules
     */
     public function messages(){
        return [
            'title.required'=>'标题不能为空',
            'realname.required'=>'姓名不能为空',
            'body.required'=>'内容不能为空',
            'email.require_all'=>'email为空或不符合要求',
            'platform.reuqired'=>'平台不能为空',    
            'tellphone.mobile'=>'电话号码不正确'
        ];
    }
    
    
    
}
