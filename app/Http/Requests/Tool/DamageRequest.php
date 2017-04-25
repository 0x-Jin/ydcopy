<?php
//验证要注入的数据
namespace App\Http\Requests\Tool;

use App\Http\Requests\Request;

class DamageRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'shipmentno'=>'required',
            'customer'=>'required',
            'assumed_ratio'=>'required',
            'assumed_sum'=>'required',
        ];
    }
    
    /**
     * Get the message if do not pass the rules
     */
     public function messages(){
        return [
            'shipmentno.required'=>'配货单号不能为空',
            'realname.required'=>'姓名不能为空',
            'assumed_ratio.required'=>'请选择承担方式',
            'assumed_sum.required'=>'请输入承担金额'
        ];
    }
    
    
    
}
