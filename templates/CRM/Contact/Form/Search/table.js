(function($){
  $(window).load(function(){
    /**
     * Return search value input 
     * @param  {jQuery Object} context 
     * @return {jQuery Object}         
     */
    var getSearchValueInput = function(context) {
      var span = $(context).siblings('.crm-search-value')[0];
      return $(span).find('input')[0];      
    };

    /**
     * Insert the 'Proximity Distance Unit' select element
     * @param  {jQuery Object} context 
     * @param  {string} value   The selected option's value
     * @return {null}         
     */
    var insertProxDistanceUnitSelect = function(context, value) {
      var input = getSearchValueInput(context);

      var sel = '<select name="' + input.name + '" class="crm-form-select required ls-form-select">';
      sel += '<option ' + (value === 'miles' ? 'selected' : '') + ' value="miles">Miles</option>';
      sel += '<option ' + (value === 'kilos' ? 'selected' : '') + ' value="kilos">Kilometers</option>';
      sel += '</select>';
      
      $(context).parent().find('.crm-search-value').before(sel);
      $(input).attr('disabled', true).addClass('hidden');
    };

    /**
     * Remove the 'Proximity Distance Unit' select element
     * @param  {jQuery Object} context 
     * @return {null}         
     */
    var removeProxDistanceSelect = function(context) {
        var input = getSearchValueInput(context);
        $(context).parent().find('.ls-form-select').remove();
        $(input).attr('disabled', false).removeClass('hidden');
    };

    /**
     * Set the operator to '=' by default when 'Proximity Distance Unit' is selected
     * @param  {jQuery Object} context  
     * @param  {string} operator The operator to change to
     * @return {null}          
     */
    var changeOperator = function(context, operator){
      var operatorSelect = $(context).siblings('select[name*="operator"]')[0];
      $(operatorSelect).val(operator);
    };

    // Insert/Remove 'Proximity Distance Unit' select element
    $('select[name*="mapper"]').change(function(e){

      if('prox_distance_unit' === this.value) {
        insertProxDistanceUnitSelect(this, '');
        changeOperator(this, '=');
      }
      else {
        removeProxDistanceSelect(this);
      }
    });

    // Set 'Proximity Distance Unit' select element after search query
    $('select[name*="mapper"]').each(function(i, v) {
      if('prox_distance_unit' == this.value) {
        var input = getSearchValueInput(this);
        insertProxDistanceUnitSelect(this, input.value);
      }
    });
  });
})(jQuery);
