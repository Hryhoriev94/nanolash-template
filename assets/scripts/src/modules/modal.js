export class Modal {
    constructor() {
        // Создание элементов модального окна
        this.modalElement = document.createElement('div');
        this.modalContent = document.createElement('div');
        this.closeButton = document.createElement('button');
        
        // Установка классов для стилизации
        this.modalElement.classList.add('modal');
        this.modalContent.classList.add('modal-content', 'container');
        this.closeButton.classList.add('close-button');
        
        // Добавление кнопки закрытия и контента в модальное окно
        this.modalElement.appendChild(this.modalContent);
        this.modalContent.appendChild(this.closeButton);
        
        // Добавление модального окна в DOM
        document.body.appendChild(this.modalElement);  // Эта строка добавляет модальное окно в DOM
        
        // Назначение обработчика событий для закрытия модального окна
        this.closeButton.innerText = 'X';
        this.closeButton.addEventListener('click', () => this.close());
        this.modalElement.addEventListener('click', (event) => {
            if (!this.modalContent.contains(event.target)) {
                this.close();
            }
        });
    }
    
    open(contentStructure) {
        // Отображение модального окна
        this.modalElement.classList.add('show');
        
        // Очистка предыдущего контента
        this.modalContent.innerHTML = '';
        this.modalContent.appendChild(this.closeButton);  // Эта строка убедится, что кнопка закрытия всегда будет присутствовать
        // Добавление нового контента в модальное окно
        contentStructure.forEach(item => {
            const element = document.createElement(item.tag);
            if (item.text) element.innerText = item.text;
            if (item.html) element.innerHTML = item.html;
            this.modalContent.appendChild(element);
        });
    }
    
    close() {
        // Скрытие модального окна и очистка его содержимого
        this.modalElement.classList.remove('show');
        this.modalContent.innerHTML = '';
        this.modalContent.appendChild(this.closeButton);  // Эта строка убедится, что кнопка закрытия всегда будет присутствовать
    }
}
