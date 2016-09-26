<?php
 // use backend\assets\Photo;
 use yii\helpers\Url;
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
?>
    <div class="span10 content-right">
    <div class="container-fluid">
    <div class="row-fluid">
    <div class="w">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'shop_name')->textInput()->label("商户名称") ?>
        <?= $form->field($model, 'ent_id')->dropDownList($hosInfo, ['prompt'=>'请选择', 'onchange'=>"getValue(this.id)"])->label("关联商户编号") ?>
        <?= $form->field($model, 'shop_type')->dropDownList($dictInfo, ['prompt'=>'请选择', 'onchange'=>"getValue(this.id)"])->label("商户类型") ?>
        <label class="control-label" for="base-shop_name">创建日期：<?= date("Y-m-d")?></label>
        <?= $form->field($upload, 'file')->fileInput() ->label("营业执照（附件）")?>
        <?= $form->field($model, 'service_scope')->textArea(['rows' => '6'])->label("服务范围") ?>
        <?= $form->field($model, 'phone')->textInput()->label("联系电话") ?>
        <?= $form->field($model, 'contact_person')->textInput()->label("联系人") ?>
        <?= $form->field($model, 'description')->textArea(['rows' => '6'])->label("商户介绍") ?>
        <?= $form->field($model, 'area_code')->dropDownList($areaInfo, ['prompt'=>'请选择','id'=>"selProvince"])->label("商户地址") ?>
        <?= $form->field($model, 'area_code')->dropDownList($areaInfo, ['prompt'=>'请选择','id'=>"selCity"])->label("") ?>
        <?= $form->field($model, 'area_code')->dropDownList($areaInfo, ['prompt'=>'请选择','id'=>"selDistrict"])->label("") ?>
        <span class="addres1"></span>
        <?= $form->field($model, 'address')->textArea(['rows' => '3'])->label("") ?>
        <?= $form->field($model, 'shop_status')->radioList(array('停用', '正常'))->label(''); ?>
        <?= Html::submitButton('submit', ['class' => "btn btn-primary"])?>
    <?php ActiveForm::end(); ?>
    </div>
    </div>
    </div>
    </div>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript">
    var provinceJson = <?=$provice?>;
    var cityJson = <?=$city?>;
    var countyJson = <?=$county?>;
    $.each(provinceJson, function(k, p) {
    var option = "<option value='" + p.id + "'>" + p.province + "</option>";
    $("#selProvince").append(option);
    });
    $("#selProvince").change(function() {
        var selValue = $(this).val();
        $("#selCity option:gt(0)").remove();
        $.each(cityJson, function(k, p) {
            if (p.id == selValue || p.parent == selValue) {
                var option = "<option value='" + p.id + "'>" + p.city + "</option>";
                $("#selCity").append(option);
            }
        });
    });
    $("#selCity").change(function() {
        var selValue = $(this).val();
        $("#selDistrict option:gt(0)").remove();
        $.each(countyJson, function(k, p) {
            if (p.parent == selValue) {
                var option = "<option value='" + p.id + "'>" + p.county + "</option>";
                $("#selDistrict").append(option);
            }
        });
    });    
</script>