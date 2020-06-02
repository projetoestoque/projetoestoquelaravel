<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    M.updateTextFields();
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      i18n: {
            cancel: 'Cancelar',
            clear: 'Limpar',
            done: 'Ok',
            monthsShort:	[
                            'Jan',
                            'Feb',
                            'Mar',
                            'Abr',
                            'Mai',
                            'Jun',
                            'Jul',
                            'Ago',
                            'Set',
                            'Out',
                            'Nov',
                            'Dez'
                          ],
            months:	[
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                  ],
            weekdays:[
                        'Domingo',
                        'Segunda-Feira',
                        'Terça-Feira',
                        'Quarta-Feira',
                        'Quinta-Feira',
                        'Sexta-Feira',
                        'Sábado'
                      ],
            weekdaysShort:[
                            'Dom',
                            'Seg',
                            'Ter',
                            'Qua',
                            'Qui',
                            'Sex',
                            'Sáb'
                          ],
            weekdaysAbbrev:['D','S','T','Q','Q','S','S']
        }
    });
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();
    $(".dropdown-trigger").dropdown({ 
      hover: true,
      alignment:'right',
      coverTrigger:false,
      constrain_width: true, 
      focusedIndex:2
      });
    $('.chips').chips();
  });
</script>
</body>
</html>