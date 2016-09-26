<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Base;
use common\helper\CommonFun;
use common\models\UploadForm;
use common\service\ShopService;
use common\service\DictService;

/**
 *
 * 商户账号管理
 */
class ShopController extends Controller
{
    public $info = array();
    //添加商户
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            var_dump("尼玛！怎么不验证啊！");
        } else {
            $hosInfo = ShopService::getSelectHos();
            $dictInfo = ShopService::getSelectDict();
            $areaInfo = ShopService::getSelectArea();
            return $this->render(
                'add',
                [
                'hosInfo' => CommonFun::selectStyle($hosInfo, 'ent_id', 'hospital_name'),
                'dictInfo' => CommonFun::selectStyle($dictInfo, 'dictionary_type', DictService::$TYPE_ARR, true),
                'provice' => json_encode(CommonFun::provice($areaInfo)['provice']),
                'city' => json_encode(CommonFun::provice($areaInfo)['city']),
                'county' => json_encode(CommonFun::provice($areaInfo)['county']),
                'model' => new Base(),
                'upload' => new UploadForm(),
                ]
            );
        }
    }
}
