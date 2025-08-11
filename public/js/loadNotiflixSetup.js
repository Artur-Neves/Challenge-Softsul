document.addEventListener("DOMContentLoaded", function () {
    initNotiflix()
});

/**
 * Essa função recebe como parâmetro a resposta de uma requisição e exibe uma mensagem
 * com Notiflix na tela e imprime uma mensagem no console referente ao erro que ocorreu
 * (somente se o modo DEBUG estiver ativo no .env). Caso a requisição tenha sido bem
 * sucedida o Notiflix vai durar mais tempo, pois a mensagem é mais longa que o normal.
 * @param {object} response
 */
function notifyError(response) {
    // Indica um erro no método onSuccess do customFetch
    if (response.status < 300) {
        Notiflix.Notify.failure(response.error, { timeout: 4000 })
    }

    // Indica um erro no controller da API
    else {
        Notiflix.Notify.failure(response.error)
    }

    // Imprime no console o stackTrace do erro, caso o modo de DEBUG esteja ativo no .env
    if (appDebug) {
        console.error(response.message)
    }
}
