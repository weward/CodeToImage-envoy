<?php 

namespace App\Services\User;

use App\Models\Code;

class CodeService
{
    public function __construct()
    {
        
    }

    public function getCodes()
    {
        return Code::with(['style', 'language'])
            ->latest()
            ->get();
    }

    public function save($request)
    {
        try {
            $code = new Code;
            $code->title = $request->title;
            $code->code = json_encode($request->code);
            $code->user_id = 1;
            $code->style_id = $request->style_id;
            $code->language_id = $request->language_id;
            $code->code_bg = $request->code_bg;
    
            $code->save();

            return $code;
        } catch (\Throwable $th) {
            info($th->getMessage());
        }

        return false;
    }

    public function update($request, $code)
    {
        try {
            $code->title = $request->title;
            $code->code = json_encode($request->code);
            $code->user_id = 1;
            $code->style_id = $request->style_id;
            $code->code_bg = $request->code_bg;

            $code->save();

            return $code;
        } catch (\Throwable $th) {
            info($th->getMessage());
        }

        return false;
    }

    public function destroy($id)
    {
        info("service ID");
        info($id);
        $code = Code::where('id', $id)->first();
        info($code);
        return $code->delete();
    }

}