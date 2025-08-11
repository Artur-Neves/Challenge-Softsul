function initNotiflix() {
    Notiflix.Notify.init({
        width: 'max-content',
        position: 'center-top',
        borderRadius: '15px',
        distance: '75px',
        pauseOnHover: false,
        cssAnimation: true,
        cssAnimationDuration: 400,
        cssAnimationStyle: 'from-top',
        fontSize: '14px',
        showOnlyTheLastOne: true,
        success: {
            background: '#ebfff3',
            textColor: '#28b664',
            childClassName: 'notiflix-notify-success',
            notiflixIconColor: '#2ecc71',
            backOverlayColor: 'rgba(50,198,130,0.2)',
        },
        failure: {
            background: '#ffeaea',
            textColor: '#d11f1f',
            childClassName: 'notiflix-notify-failure',
            notiflixIconColor: '#d11f1f',
            backOverlayColor: 'rgba(255,85,73,0.2)',
        },
        warning: {
            background: '#fff6db',
            textColor: '#d1a82b',
            childClassName: 'notiflix-notify-warning',
            notiflixIconColor: '#eebf31',
            backOverlayColor: 'rgba(238,191,49,0.2)',
        },
        info: {
            background: '#fff',
            textColor: 'rgba(0,0,0,0.7)',
            childClassName: 'notiflix-notify-info',
            notiflixIconColor: 'rgba(0,0,0,0.2)',
            backOverlayColor: 'rgba(38,192,211,0.2)',
        }
    });

}
