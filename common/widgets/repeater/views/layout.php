<?php
use richardfan\widget\JSRegister;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonnelMovement */
?>

<div class="container-fluid">
    <div class="card card-secondary card-outline">
        <div class="card-header header-primary">
            <span class="mr-auto"><i class="fa fa-retweet"></i> Movimentação</span>
            <button type="button" class="btn btn-sm btn-info float-right" id="move-add">Adicionar &nbsp;<i class="fa fa-plus"></i></button>
        </div>
        <div id="move-rows" class="card-body">
            <?php
            if($model->move_detail){
                foreach ($model->move_detail as $key => $move){ ?>
                    <div  id="row-<?= $key ?>" class="row move-row-group">
                        <div class="col-12 form-group">
                            <label for="">Movimentação</label>
                            <div class="input-group">
                                <select name="PersonnelMovement[move_detail][<?= $key ?>][type]" value="<?= $move['type'] ?>" class="form-control form-control-sm" style="width: 50%" placeholder="Movimentação">
                                    <option <?= $move['type'] === 'CARGO' ? 'selected':'unselected'; ?> value="CARGO"></option>
                                    <option <?= $move['type'] === 'SALARIO' ? 'selected':''; ?> value="SALARIO">SALARIO</option>
                                    <option <?= $move['type'] === 'SETOR' ? 'selected':''; ?> value="SETOR">SETOR</option>
                                    <option <?= $move['type'] === 'DEPARTAMENTO' ? 'selected':''; ?> value="DEPARTAMENTO">DEPARTAMENTO</option>
                                    <option <?= $move['type'] === 'CENTRO_DE_CUSTO' ? 'selected':''; ?> value="CENTRO_DE_CUSTO">CENTRO_DE_CUSTO</option>
                                    <option <?= $move['type'] === 'CIDADE_ESTADO' ? 'selected':''; ?> value="CIDADE_ESTADO">CIDADE_ESTADO</option>
                                    <option <?= $move['type'] === 'INSALUBRIDADE' ? 'selected':''; ?> value="INSALUBRIDADE">INSALUBRIDADE</option>
                                    <option <?= $move['type'] === 'PERICULOSIDADE' ? 'selected':''; ?> value="PERICULOSIDADE">PERICULOSIDADE</option>
                                    <option <?= $move['type'] === 'ASSIDUIDADE' ? 'selected':''; ?> value="ASSIDUIDADE">ASSIDUIDADE</option>
                                    <option <?= $move['type'] === 'VALE_TRANSPORTE' ? 'selected':''; ?> value="VALE_TRANSPORTE">VALE_TRANSPORTE</option>
                                    <option <?= $move['type'] === 'AJUDA_DE_CUSTO' ? 'selected':''; ?> value="AJUDA_DE_CUSTO">AJUDA_DE_CUSTO</option>
                                    <option <?= $move['type'] === 'VALE_ALIMENTACAO' ? 'selected':''; ?> value="VALE_ALIMENTACAO">VALE_ALIMENTACAO</option>
                                    <option <?= $move['type'] === 'VALE_REFEICAO' ? 'selected':''; ?> value="VALE_REFEICAO">VALE_REFEICAO</option>
                                    <option <?= $move['type'] === 'CARGA_HORARIA' ? 'selected':''; ?> value="CARGA_HORARIA">CARGA_HORARIA</option>
                                    <option <?= $move['type'] === 'HORARIO_DE_TRABALHO' ? 'selected':''; ?> value="HORARIO_DE_TRABALHO">HORARIO_DE_TRABALHO</option>
                                    <option <?= $move['type'] === 'GRATIFICACAO_PELA_FUNCAO' ? 'selected':''; ?> value="GRATIFICACAO_PELA_FUNCAO">GRATIFICACAOO_PELA_FUNCAO</option>
                                </select>
                                <input type="text" name="PersonnelMovement[move_detail][<?=$key?>][name]" value="<?= $move['name'] ?>" class="form-control form-control-sm" style="width:20%" placeholder="Atual">
                                <input type="text" name="PersonnelMovement[move_detail][<?=$key?>][info]" value="<?= $move['info'] ?>" class="form-control form-control-sm" style="width:20%" placeholder="Proposta">
                                <div class="input-group-append">
                                    <button data-key="<?= $key ?>" type="button" class="btn btn-sm btn-warning btn-trash"> &nbsp;<i class="fa fa-minus"></i>&nbsp; </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>

<?php JSRegister::begin([
    'position' => \yii\web\View::POS_READY
]); ?>
    <script>
    $('#move-add').click(function(){
        let hash = Math.random() //0.9394456857981651
        hash.toString(36); //'0.xtis06h6'
        let key = hash.toString(36).substr(2, 9); //'xtis06h6'

        let group = `<div id="row-${key}" class="row move-row-group">
            <div class="col-12 form-group">
                <label for="">Movimentação</label>
                <div class="input-group">
                    <select name="PersonnelMovement[move_detail][${key}][type]" class="form-control form-control-sm" style="width:50%" placeholder="Movimentação">
                        <option value="CARGO"></option>
                        <option value="SALARIO">SALARIO</option>
                        <option value="SETOR">SETOR</option>
                        <option value="DEPARTAMENTO">DEPARTAMENTO</option>
                        <option value="CENTRO_DE_CUSTO">CENTRO_DE_CUSTO</option>
                        <option value="CIDADE_ESTADO">CIDADE_ESTADO</option>
                        <option value="INSALUBRIDADE">INSALUBRIDADE</option>
                        <option value="PERICULOSIDADE">PERICULOSIDADE</option>
                        <option value="ASSIDUIDADE">ASSIDUIDADE</option>
                        <option value="VALE_TRANSPORTE">VALE_TRANSPORTE</option>
                        <option value="AJUDA_DE_CUSTO">AJUDA_DE_CUSTO</option>
                        <option value="VALE_ALIMENTACAO">VALE_ALIMENTACAO</option>
                        <option value="VALE_REFEICAO">VALE_REFEICAO</option>
                        <option value="CARGA_HORARIA">CARGA_HORARIA</option>
                        <option value="HORARIO_DE_TRABALHO">HORARIO_DE_TRABALHO</option>
                        <option value="GRATIFICACAOO_PELA_FUNCAO">GRATIFICACAOO_PELA_FUNCAO</option>
                    </select>
                    <input type="text" name="PersonnelMovement[move_detail][${key}][name]" class="form-control form-control-sm" style="width:20%" placeholder="Atual">
                    <input type="text" name="PersonnelMovement[move_detail][${key}][info]" class="form-control form-control-sm" style="width:20%" placeholder="Proposta">
                    <div class="input-group-append">
                        <button data-key="${key}" class="btn btn-sm btn-warning btn-trash">&nbsp;<i class="fa fa-minus"></i>&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>`;
        $('#move-rows').append(group);
    })

    $(document).on('click', '.btn-trash', function(){
        let key = $(this).attr('data-key');
        $('#row-'+key).remove();
    })
    </script>
<?php JSRegister::end(); ?>