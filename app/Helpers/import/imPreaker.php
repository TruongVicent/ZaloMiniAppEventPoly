<?php

namespace App\Helpers\Import;

use App\Helpers\NotificationHelper;
use App\Models\Preaker;

class imPreaker
{


    /**
     * @return void
     */
    public static function import($sheetData)
    {
        $total = 0;
        foreach ($sheetData as $key => $data) {
            if ($key >= 1) {
                if ((new imPreaker())->addData($data)) {
                    $total++;
                }
            }
        }
        if ($total > 0) {
            NotificationHelper::success('Đã thêm hoặc cập nhật lại ' . $total . ' giản viên');
        } else {
            NotificationHelper::error('Không thêm được dữ liệu nào, tất cả dữ liệu đã được thêm trước đó hoặc file dữ liệu chưa hợp lệ!.');
        }
    }

    /**
     * @param $customerData
     *
     * @return bool
     */
    public function addData($data){
        if (!$this->findByCode(code: $data[0])){
            $preakers              = new Preaker();
            $preakers->id        = $data[0];
            $preakers->name    = $data[1];
            if ($preakers->save()){
//                dd($district);
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * @param $code
     *
     * @return bool
     */
    private function findByCode($code){
        $district = Preaker::where('id', $code)->first();

        if ($district == NULL){
            return FALSE;
        }
        return TRUE;
    }


}
