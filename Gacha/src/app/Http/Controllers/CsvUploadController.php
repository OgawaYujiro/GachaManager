<?php

namespace App\Http\Controllers;
use App\Models\Gacha;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CsvUploadController extends Controller
{
    public function index()
    {
        return view('gacha.csv',[
            'message' => 'CSVファイルを選択してください。',
        ]);
    }

    public function finish(Request $request)
    {
        DB::table('gachas')->delete();

        // ファイルバリデーション
        $file_validation_array = [
            'csv_file' => [
                        'required',
                        'max:1024',
                        'file',
                        'mimes:csv,txt',
            ],
        ];

        $file_validator = Validator::make($request->all(), $file_validation_array);

        if ($file_validator->fails()) {
            return redirect('/csv')
                        ->withErrors($file_validator);
        };

        // ファイル名取得
        $csv_name = $request->file('csv_file')->getClientOriginalName();

        // ファイル保存
        $csv_path = $request->file('csv_file')->storeAs('csv_data', $csv_name);

        // CSV情報の取得
        $csv_content = new \SplFileObject(storage_path('app/csv_data/'.$csv_name));
 
        $csv_content->setFlags(
          \SplFileObject::READ_CSV |
          \SplFileObject::READ_AHEAD |
          \SplFileObject::SKIP_EMPTY |
          \SplFileObject::DROP_NEW_LINE
        );        

        $csv_data = [];

        foreach($csv_content as $value) {

            
            $value = mb_convert_encoding($value, "UTF-8");
    
            if($value[0] == "id")
            {
                if($value[1] == "name")
                {
                    if($value[2] == "content")
                        continue;
                }
            }

            $csv_data[] = [
                'id' => $value[0],
                'name' => $value[1],
                'content' => $value[2],
            ];
            
        }

        // CSVデータのバリデーション
        $data_validation_array = [ 
            '*.name' =>['required', 'string'], 
            '*.content' =>['required', 'string'], 
        ];

        $csv_validator = Validator::make($csv_data, $data_validation_array);

        if ($csv_validator->fails()) {

            // CSVファイルの削除
            Storage::delete('csv_data/'.$csv_name);

            return redirect('/csv')
                        ->withErrors($csv_validator);
        };

        // 登録処理
        DB::beginTransaction();
        try {
            
            foreach($csv_data as $value){
                $user_data = DB::table('gachas')->insert([
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'content' => $value['content']
                ]);
            }

            DB::commit();

            $message = "登録処理が完了しました。";

        } catch (Throwable $e) {

            DB::rollBack();
            $message = "登録処理に失敗しました。";

        }

        // CSVファイルの削除
        Storage::delete('csv_data/'.$csv_name);
        
        return view('gacha.csv',[
            'message' => $message,
        ]);
    }
}
