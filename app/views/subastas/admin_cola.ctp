<div>
  <h2><?php __('Subastas');?></h2>
  <table cellpadding="0" cellspacing="0" id="sortable" controller="subastas">
  <tr class='ui-state-disabled'>
      <th>Nombre</th>
      <th>Valor</th>
      <th>Umbral Minimo de Creditos</th>
      <th>Imagen</th>
      <th>Estado</th>
  </tr>
  <?php
  $i = 0;
  foreach ($subastas as $subasta):
    $class =  ' class="ui-state-default "';
    if ($i++ % 2 == 0) {
      $class = ' class="altrow ui-state-default"';
    }
  ?>
  <tr<?php echo $class;?> id="<?php echo $subasta['Subasta']['id']?>">
    <td><?php echo $subasta['Subasta']['nombre']; ?>&nbsp;</td>
    <td><?php echo $subasta['Subasta']['valor']; ?>&nbsp;</td>
    <td><?php echo $subasta['Subasta']['umbral_minimo_creditos']; ?>&nbsp;</td>
    <td><?php echo $html->image($subasta['Subasta']['imagen_path'],array("width"=>"200")); ?>&nbsp;</td>
    <td><?php echo $subasta['EstadosSubasta']['nombre']; ?>&nbsp;</td>
  </tr>
<?php endforeach; ?>
  </table>
 </div>