<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/static/css/main.css">

</head>
<body>

    <div class='s-pre-con'>
        <img src="/static/img/loader.gif" alt="Loading cool animation">
    </div>

    <div class="row">
        <div class="col-8">
            <h2 id="Info-text"></h2>
        </div>
        <div class="col">
            <button class="btn btn-primary mt-2" id="btnTogRaw"></button>
        </div>
    </div>    
    <hr>

    <div id="controlRaw">        
    </div>

    <div id="controlTable">
        <div class="row">
            <div class="col">                
                <table class="table table-striped table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>                                           
                            <th scope="col">Chave</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach($cadastro as $ch => $val): ?>
                            <?php if(!empty($val)): ?>
                            <tr>
                                <td><?= esc($ch); ?></td>
                                <td><?= esc($val); ?></td>
                            </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>  
        
        <h2>Contatos</h2> 
        <hr>

        <h6>Telefones</h6>
        <div class="row">
        <?php $idNumero = 0; ?>
        <?php foreach($contato->telefone as $telefones): ?>         
            <div class="col">
                <table class="table table-striped table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>                                           
                            <th scope="col">Chave</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    <?php $indexVal = 0; $telefone = ''; ?>                                   
                    <?php foreach($telefones as $ch => $val): ?>
                        <?php if(!empty($val) && $ch != 'ordem'): ?>
                        <tr>
                            <td><?= esc($ch); ?></td>
                            <td><?= esc($val); ?></td>
                        </tr>
                        <?php if($indexVal == 0 || $indexVal == 1){
                            $telefone .= $val;
                        } ?>                                                
                        <?php $indexVal++; ?>                                   
                        <?php endif ?>
                    <?php endforeach ?>                        
                    </tbody>                           
                </table>
                <input type="text" name="telefone<?= $idNumero ?>" id="telefone<?= $idNumero ?>" value="<?= $telefone ?>" style="position:absolute;left:-9999px;z-index:-9999;">
                <button type="button" class="btn btn-success ml-4" onclick="copyClip('telefone<?= $idNumero ?>')">Copiar</button>  
            </div>
        <?php $idNumero++; ?>
        <?php endforeach ?>
        </div>
        <script>
            function copyClip($idVal){
                 $('#'+$idVal).select();                            
                document.execCommand("copy");
            }
        </script>

        <h6>Emails</h6>
        <div class="row">
        <?php foreach($contato->email as $emails): ?> 
            <div class="col">
                <table class="table table-striped table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>                                           
                            <th scope="col">Chave</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">                                   
                    <?php foreach($emails as $ch => $val): ?>
                        <?php if(!empty($val) && $ch != 'ordem'): ?>
                        <tr>
                            <td><?= esc($ch); ?></td>
                            <td><?= esc($val); ?></td>
                        </tr>
                        <?php endif ?>
                    <?php endforeach ?>                                                            
                    </tbody>
                </table>            
            </div>
        <?php endforeach ?>
        </div>

        <h2>Endereços</h2> 
        <hr>

        <div class="row">
        <?php foreach($contato->endereco as $enderecos): ?>
            <div class="col">
                <table class="table table-striped table-responsive w-100 d-block d-md-table">
                    <thead>
                        <tr>                                           
                            <th scope="col">Chave</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">                                    
                    <?php foreach($enderecos as $ch => $val): ?>
                        <?php if(!empty($val)): ?>                            
                        <tr>
                            <td><?= esc($ch); ?></td>
                            <td><?= esc($val); ?></td>
                        </tr>
                        <?php endif ?>
                    <?php endforeach ?>                                        
                    </tbody>
                </table>
            </div>
        <?php endforeach ?>
        </div>
    </div>    

<script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>  

<script>
    state = {
        'title': 'Informações pessoais',
        'btnTxt': 'Visualizar informações cruas',
        'rawToggle': false,
        'rawJSON': <?= $raw ?>
    };


    $('#btnTogRaw').on('click', () => {
        if(state.rawToggle){
            state.rawToggle = false;
            state.btnTxt = 'Visualizar informações cruas';
            state.title = 'Informações pessoais';

            $('#controlTable').show();
            $('#controlRaw').hide();
        }else{
            state.rawToggle = true;
            state.btnTxt = 'Visualizar tabela';
            state.title = 'Dados crus - JSON'; 

            $('#controlRaw').show();
            $('#controlTable').hide();
        }
        

        $('#Info-text').html(state.title);
        $('#btnTogRaw').text(state.btnTxt);
    })

    $('#Info-text').html(state.title);
    $('#btnTogRaw').text(state.btnTxt);
    $('#controlRaw').html("<pre>"+JSON.stringify(state.rawJSON, null, '\t')+"</pre>");
    $('#controlRaw').hide();

    $('.s-pre-con').show();
    $(document).ready(() => {
        $('.s-pre-con').hide();
    });
</script>
</body>
</html>