/*=========================================================================================
	File Name: tour.js
	Description: tour
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function() {
    'use strict';

    var startBtn = $('#tour');

    function setupTour(tour) {
        var backBtnClass = 'btn btn-sm btn-outline-primary',
            nextBtnClass = 'btn btn-sm btn-primary btn-next';
        tour.addStep({
            title: 'Barra de Navegação',
            text: 'Esta é a sua Barra de Navegação, nela você vai encontrar sua configurações báscas, seus acessos rápidos e seu menu de usuário.',
            attachTo: { element: '.navbar', on: 'bottom' },
            buttons: [{
                    action: tour.cancel,
                    classes: backBtnClass,
                    text: 'Pular'
                },
                {
                    text: 'Próximo',
                    classes: nextBtnClass,
                    action: tour.next
                }
            ]
        });
        tour.addStep({
            title: 'Agenda de RAS',
            text: 'esta área da agenda é onde vai encontrar todas as RAS cadastradas.',
            attachTo: { element: '#ras-orderly .card', on: 'top' },
            buttons: [{
                    text: 'Pular',
                    classes: backBtnClass,
                    action: tour.cancel
                },
                {
                    text: 'Voltar',
                    classes: backBtnClass,
                    action: tour.back
                },
                {
                    text: 'Próximo',
                    classes: nextBtnClass,
                    action: tour.next
                }
            ]
        });
        tour.addStep({
            title: 'Filtro RAS',
            text: 'esta área você consegue filtrar os RAS da agenda.',
            attachTo: { element: '#app-calendar-sidebar .sidebar-wrapper', on: 'right' },
            buttons: [{
                    text: 'Pular',
                    classes: backBtnClass,
                    action: tour.cancel
                },
                {
                    text: 'Voltar',
                    classes: backBtnClass,
                    action: tour.back
                },
                {
                    text: 'Próximo',
                    classes: nextBtnClass,
                    action: tour.next
                }
            ]
        });
        tour.addStep({
            title: 'Modelo de datas',
            text: 'aqui você pode alterar o modo de visualização da agenda.',
            attachTo: { element: '.fc-button-group', on: 'left' },
            buttons: [{
                    text: 'Voltar',
                    classes: backBtnClass,
                    action: tour.back
                },
                {
                    text: 'Terminar',
                    classes: nextBtnClass,
                    action: tour.cancel
                }
            ]
        });

        return tour;
    }

    if (startBtn.length) {
        startBtn.on('click', function() {
            var tourVar = new Shepherd.Tour({
                defaultStepOptions: {
                    classes: 'shadow-md bg-purple-dark',
                    scrollTo: false,
                    cancelIcon: {
                        enabled: true
                    }
                },
                useModalOverlay: true
            });

            setupTour(tourVar).start();
        });
    }
});