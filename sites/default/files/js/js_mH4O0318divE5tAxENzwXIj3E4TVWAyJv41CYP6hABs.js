Drupal.locale = { 'pluralFormula': function ($n) { return Number(($n!=1)); }, 'strings': {"":{"An AJAX HTTP error occurred.":"Se produjo un error HTTP AJAX.","HTTP Result Code: !status":"C\u00f3digo de Resultado HTTP: !status","An AJAX HTTP request terminated abnormally.":"Una solicitud HTTP de AJAX termin\u00f3 de manera anormal.","Debugging information follows.":"A continuaci\u00f3n se detalla la informaci\u00f3n de depuraci\u00f3n.","Path: !uri":"Ruta: !uri","StatusText: !statusText":"StatusText: !statusText","ResponseText: !responseText":"ResponseText: !responseText","ReadyState: !readyState":"ReadyState: !readyState","Hide":"Ocultar","Show":"Mostrar","Please wait...":"Espere, por favor...","Re-order rows by numerical weight instead of dragging.":"Reordenar las filas por peso num\u00e9rico en lugar de arrastrar.","Show row weights":"Mostrar pesos de la fila","Hide row weights":"Ocultar pesos de la fila","Drag to re-order":"Arrastre para reordenar","Changes made in this table will not be saved until the form is submitted.":"Los cambios realizados en esta tabla no se guardar\u00e1n hasta que se env\u00ede el formulario","Edit":"Editar","@number comments per page":"@number comentarios por p\u00e1gina","(active tab)":"(solapa activa)","Requires a title":"Necesita un t\u00edtulo","Not published":"No publicado","Don\u0027t display post information":"No mostrar informaci\u00f3n del env\u00edo","Select all rows in this table":"Seleccionar todas las filas de esta tabla","Deselect all rows in this table":"Quitar la selecci\u00f3n a todas las filas de esta tabla","@title dialog":"Di\u00e1logo @title","Configure":"Configurar","Hide summary":"Ocultar resumen","Edit summary":"Editar resumen","Not in menu":"No est\u00e1 en un men\u00fa","New revision":"Nueva revisi\u00f3n","No revision":"Sin revisi\u00f3n","By @name on @date":"Por @name en @date","By @name":"Por @name","Automatic alias":"Alias autom\u00e1tico","Alias: @alias":"Alias: @alias","No alias":"Sin alias","Autocomplete popup":"Ventana emergente con autocompletado","Searching for matches...":"Buscando coincidencias","Not restricted":"Sin restricci\u00f3n","Restricted to certain pages":"Restringido a algunas p\u00e1ginas","Not customizable":"No personalizable","The changes to these blocks will not be saved until the \u003Cem\u003ESave blocks\u003C\/em\u003E button is clicked.":"Los cambios sobre estos bloques no se guardar\u00e1n hasta que no pulse el bot\u00f3n \u003Cem\u003EGuardar bloques\u003C\/em\u003E.","The block cannot be placed in this region.":"El bloque no se puede colocar en esta regi\u00f3n.","Translatable":"Traducible","Not translatable":"No traducible","Restricted to certain languages":"Restringido a ciertos idiomas","Customize dashboard":"Personalizar panel de control","Add":"Agregar","Recent":"Reciente","All":"Todo(s)","Loading token browser...":"Cargando navegador de comodines...","Available tokens":"Comodines disponibles","Insert this token into your form":"Inserte este comod\u00edn en su formulario","First click a text field to insert your tokens into.":"Primero haga clic en un campo de texto en el que quiera insertar sus patrones de reemplazo.","Remove this pane?":"\u00bfEliminar este panel?","Hide layout designer":"Ocultar el maquetador de dise\u00f1o","Show layout designer":"Mostrar maquetador de dise\u00f1o.","Hide description":"Esconder descripci\u00f3n","Show description":"Mostrar descripci\u00f3n","Also allow !name role to !permission?":"\u00bfTambi\u00e9n permitir al rol !name el permiso !permission?","OK":"OK","The selected file %filename cannot be uploaded. Only files with the following extensions are allowed: %extensions.":"El archivo seleccionado %filename no puede ser subido. Solo se permiten archivos con las siguientes extensiones: %extensions.","Enabled":"Activado","Disabled":"Desactivado","Remove group":"Eliminar grupo","Apply (all displays)":"Aplicar (todas las presentaciones)","Revert to default":"Volver al valor inicial","Apply (this display)":"Aplicar (esta presentaci\u00f3n)","Upload":"Subir al servidor","You can not perform this operation.":"No puede realizar esta operaci\u00f3n.","Do you want to refresh the current directory?":"\u00bfQuiere actualizar la vista de este directorio?","Only files with the following extensions are allowed: %files-allowed.":"S\u00f3lo se permiten archivos con las siguientes extensiones: %files-allowed.","Delete selected files?":"\u00bfBorrar los documentos seleccionados?","Please select a thumbnail.":"Seleccione una minatura, por favor.","Please specify dimensions within the allowed range that is from 1x1 to @dimensions.":"Especifique unas dimensiones dentro de las permitidas, por favor. Eso va desde 1 \u00d7 1 a @dimensions.","Please select a file.":"Seleccione un documento, por favor.","Log messages":"Registrar mensajes","%filename is not an image.":"%filename no es una imagen.","You must select at least %num files.":"Debe seleccionar al menos %num documentos.","You are not allowed to operate on more than %num files.":"No tiene permiso para actuar sobre m\u00e1s de %num documentos.","Close":"Cerrar","Change view":"Cambiar vista","Insert file":"Insertar archivo","Changes to the checkout panes will not be saved until the \u003Cem\u003ESave configuration\u003C\/em\u003E button is clicked.":"Los cambios a los paneles de pedido no ser\u00e1n guardados hasta que el bot\u00f3n de \u003Cem\u003E Guardar Configuraci\u00f3n \u003C\/em\u003E sea presionado.","This permission is inherited from the authenticated user role.":"Este permiso se hereda del rol de usuario registrado.","From @title":"De @title","To @title":"A @title","Created @date":"Creado @date","New order":"Nuevo pedido","Updated @date":"Actualizado @date","Done":"Hecho","Select":"Seleccionar","none":"ninguno","Save":"Guardar","Loading...":"Cargando...","Submit":"Enviar","Cancel":"Cancelar","all":"todo","New":"Nuevo","Add file":"Agregar archivo","Ignored from settings":"Ignorado por los ajustes","No results":"No hay resultados","clear":"limpiar","Modules installed within the last week.":"M\u00f3dulos instalados en la \u00faltima semana.","No modules added within the last week.":"No hay m\u00f3dulos adicionados en la \u00faltima semana.","Modules enabled\/disabled within the last week.":"M\u00f3dulos habilitados\/deshabilitados en la \u00faltima semana.","No modules were enabled or disabled within the last week.":"No hay m\u00f3dulos habilitados o deshabilitados en la \u00faltima semana.","@enabled of @total":"@enabled de @total"}} };;
(function(){
  function sortDrupalBehaviors() {
    var weights = {};
    for (var k in Drupal.behaviors) {
      var v = Drupal.behaviors[k];
      var pieces = k.split('.');
      if (pieces.length == 2 && pieces[1] === 'weight') {
        // This v is not a behavior, but a weight setting for another behavior.
        weights[pieces[0]] = v;
        delete Drupal.behaviors[k];
      }
      else if (typeof weights[k] != 'number') {
        // This v is a behavior object, but it might contain a weight setting.
        if (typeof v == 'object' && v && typeof v.weight == 'number') {
          weights[k] = v.weight;
        }
        else if (weights[k] == undefined) {
          weights[k] = false;
        }
      }
    }

    var ww = [0];
    var by_weight = {0: {}};
    for (var k in weights) {
      if (Drupal.behaviors[k] == undefined) {
        continue;
      }
      var w = weights[k];
      w = (typeof w == 'number') ? w : 0;
      if (by_weight[w] == undefined) {
        by_weight[w] = {};
        ww.push(w);
      }
      by_weight[w][k] = Drupal.behaviors[k];
    }
    ww.sort(function(a,b){return a - b;});

    // Other scripts that want to mess with behaviors, will only see those with weight = 0.
    Drupal.behaviors = by_weight[0];

    var sorted = [];
    for (var i = 0; i < ww.length; ++i) {
      var w = ww[i];
      sorted.push(by_weight[w]);
    }
    return sorted;
  }

  var attachBehaviors_original = Drupal.attachBehaviors;

  Drupal.attachBehaviors = function(context, settings) {
    var sorted = sortDrupalBehaviors();
    Drupal.attachBehaviors = function(context, settings) {
      context = context || document;
      settings = settings || Drupal.settings;
      // Execute all of them.
      for (var i = 0; i < sorted.length; ++i) {
        jQuery.each(sorted[i], function() {
          if (typeof this.attach == 'function') {
            this.attach(context, settings);
          }
        });
      }
    }
    Drupal.attachBehaviors.apply(this, [context, settings]);
  };

})();

;
/**
 * @file
 * Attaches behaviors for the Dashboard module.
 */

(function ($) {

/**
 * Implements Drupal.behaviors for the Dashboard module.
 */
Drupal.behaviors.dashboard = {
  attach: function (context, settings) {
    $('#dashboard', context).once(function () {
      $(this).prepend('<div class="customize clearfix"><ul class="action-links"><li><a href="#">' + Drupal.t('Customize dashboard') + '</a></li></ul><div class="canvas"></div></div>');
      $('.customize .action-links a', this).click(Drupal.behaviors.dashboard.enterCustomizeMode);
    });
    Drupal.behaviors.dashboard.addPlaceholders();
    if (Drupal.settings.dashboard.launchCustomize) {
      Drupal.behaviors.dashboard.enterCustomizeMode();
    }
  },

  addPlaceholders: function() {
    $('#dashboard .dashboard-region .region').each(function () {
      var empty_text = "";
      // If the region is empty
      if ($('.block', this).length == 0) {
        // Check if we are in customize mode and grab the correct empty text
        if ($('#dashboard').hasClass('customize-mode')) {
          empty_text = Drupal.settings.dashboard.emptyRegionTextActive;
        } else {
          empty_text = Drupal.settings.dashboard.emptyRegionTextInactive;
        }
        // We need a placeholder.
        if ($('.dashboard-placeholder', this).length == 0) {
          $(this).append('<div class="dashboard-placeholder"></div>');
        }
        $('.dashboard-placeholder', this).html(empty_text);
      }
      else {
        $('.dashboard-placeholder', this).remove();
      }
    });
  },

  /**
   * Enters "customize" mode by displaying disabled blocks.
   */
  enterCustomizeMode: function () {
    $('#dashboard').addClass('customize-mode customize-inactive');
    Drupal.behaviors.dashboard.addPlaceholders();
    // Hide the customize link
    $('#dashboard .customize .action-links').hide();
    // Load up the disabled blocks
    $('div.customize .canvas').load(Drupal.settings.dashboard.drawer, Drupal.behaviors.dashboard.setupDrawer);
  },

  /**
   * Exits "customize" mode by simply forcing a page refresh.
   */
  exitCustomizeMode: function () {
    $('#dashboard').removeClass('customize-mode customize-inactive');
    Drupal.behaviors.dashboard.addPlaceholders();
    location.href = Drupal.settings.dashboard.dashboard;
  },

  /**
   * Sets up the drag-and-drop behavior and the 'close' button.
   */
  setupDrawer: function () {
    $('div.customize .canvas-content input').click(Drupal.behaviors.dashboard.exitCustomizeMode);
    $('div.customize .canvas-content').append('<a class="button" href="' + Drupal.settings.dashboard.dashboard + '">' + Drupal.t('Done') + '</a>');

    // Initialize drag-and-drop.
    var regions = $('#dashboard div.region');
    regions.sortable({
      connectWith: regions,
      cursor: 'move',
      cursorAt: {top:0},
      dropOnEmpty: true,
      items: '> div.block, > div.disabled-block',
      placeholder: 'block-placeholder clearfix',
      tolerance: 'pointer',
      start: Drupal.behaviors.dashboard.start,
      over: Drupal.behaviors.dashboard.over,
      sort: Drupal.behaviors.dashboard.sort,
      update: Drupal.behaviors.dashboard.update
    });
  },

  /**
   * Makes the block appear as a disabled block while dragging.
   *
   * This function is called on the jQuery UI Sortable "start" event.
   *
   * @param event
   *  The event that triggered this callback.
   * @param ui
   *  An object containing information about the item that is being dragged.
   */
  start: function (event, ui) {
    $('#dashboard').removeClass('customize-inactive');
    var item = $(ui.item);

    // If the block is already in disabled state, don't do anything.
    if (!item.hasClass('disabled-block')) {
      item.css({height: 'auto'});
    }
  },

  /**
   * Adapts block's width to the region it is moved into while dragging.
   *
   * This function is called on the jQuery UI Sortable "over" event.
   *
   * @param event
   *  The event that triggered this callback.
   * @param ui
   *  An object containing information about the item that is being dragged.
   */
  over: function (event, ui) {
    var item = $(ui.item);

    // If the block is in disabled state, remove width.
    if ($(this).closest('#disabled-blocks').length) {
      item.css('width', '');
    }
    else {
      item.css('width', $(this).width());
    }
  },

  /**
   * Adapts a block's position to stay connected with the mouse pointer.
   *
   * This function is called on the jQuery UI Sortable "sort" event.
   *
   * @param event
   *  The event that triggered this callback.
   * @param ui
   *  An object containing information about the item that is being dragged.
   */
  sort: function (event, ui) {
    var item = $(ui.item);

    if (event.pageX > ui.offset.left + item.width()) {
      item.css('left', event.pageX);
    }
  },

  /**
   * Sends block order to the server, and expand previously disabled blocks.
   *
   * This function is called on the jQuery UI Sortable "update" event.
   *
   * @param event
   *   The event that triggered this callback.
   * @param ui
   *   An object containing information about the item that was just dropped.
   */
  update: function (event, ui) {
    $('#dashboard').addClass('customize-inactive');
    var item = $(ui.item);

    // If the user dragged a disabled block, load the block contents.
    if (item.hasClass('disabled-block')) {
      var module, delta, itemClass;
      itemClass = item.attr('class');
      // Determine the block module and delta.
      module = itemClass.match(/\bmodule-(\S+)\b/)[1];
      delta = itemClass.match(/\bdelta-(\S+)\b/)[1];

      // Load the newly enabled block's content.
      $.get(Drupal.settings.dashboard.blockContent + '/' + module + '/' + delta, {},
        function (block) {
          if (block) {
            item.html(block);
          }

          if (item.find('div.content').is(':empty')) {
            item.find('div.content').html(Drupal.settings.dashboard.emptyBlockText);
          }

          Drupal.attachBehaviors(item);
        },
        'html'
      );
      // Remove the "disabled-block" class, so we don't reload its content the
      // next time it's dragged.
      item.removeClass("disabled-block");
    }

    Drupal.behaviors.dashboard.addPlaceholders();

    // Let the server know what the new block order is.
    $.post(Drupal.settings.dashboard.updatePath, {
        'form_token': Drupal.settings.dashboard.formToken,
        'regions': Drupal.behaviors.dashboard.getOrder
      }
    );
  },

  /**
   * Returns the current order of the blocks in each of the sortable regions.
   *
   * @return
   *   The current order of the blocks, in query string format.
   */
  getOrder: function () {
    var order = [];
    $('#dashboard div.region').each(function () {
      var region = $(this).parent().attr('id').replace(/-/g, '_');
      var blocks = $(this).sortable('toArray');
      $.each(blocks, function() {
        order.push(region + '[]=' + this);
      });
    });
    order = order.join('&');
    return order;
  }
};

})(jQuery);
;
