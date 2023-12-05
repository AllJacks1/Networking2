<!DOCTYPE html>
<html>

<body>

    <div class="message-item item">
        <i class="fa-regular fa-circle-user profilepic"></i>
        <div class="messeage-info">
            <div class="message-content">
                <p class="name">Kim Chaewon</p>
                <div class="message">
                    Hello, how are u? Hello, how are u?Hello, how are u?Hello,
                    how are u?Hello, how are u?
                </div>
            </div>
            <p class="time">12:30 PM</p>
        </div>
        <i class="ellipsis-menu fa-solid fa-ellipsis-vertical fa-xl">
            <div class="more-actions">
                <i class="fa-regular fa-trash-can"></i><a href="">Delete</a>
            </div>
        </i>
    </div>



    <?php

    $numbers = array(0, 1, 2);

    for ($i = 0; $i < count($numbers); $i++) {
        echo "The number is: $numbers[$i] <br>";
    }
    ?>
    <button type="button" , onclick="data1AddToInformation()">Karl</button>
    <button type="button" , onclick="data2AddToInformation()">Tan</button>

    <button type="button" , onclick="getData1Number()">Karl</button>
    <button type="button" , onclick="getData2Number()">Tan</button>


    <button type="button" , onclick="tryCode()">Code Trial</button>
</body>
<script>
    let information = [];
    let data1 = [1, "Karl", "0906460274"];
    let data2 = [2, "Tan", "09064360274"];

    function data1AddToInformation() {
        information.push(data1);
        console.log(information);
    }

    function data2AddToInformation() {
        information.push(data2);
        console.log(information);
    }

    function getData1Number() {
        console.log(information[0][2])
    }

    function getData2Number() {
        console.log(information[1][2])
    }

    const sourceArray = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ];

    const targetValue = [
        ["hello"]
    ];

    function tryCode() {
        console.log(targetValue.length);
    }








    const messageItemElements = document.querySelectorAll('.message-item');
    const table = document.getElementById('table-contacts');
    const divElement = document.getElementById('chat-members');
    const numberInput = document.getElementById('number');
    let userInformation = [];

    function addContactNumber(content) {
        const actualNumber = numberInput.value;
        userInformation.push([content, actualNumber]);
        console.log(userInformation);

        const spanElement = document.createElement('span');
        spanElement.classList.add('chatname');
        spanElement.innerHTML = `${content} <i class="remove-name fa-solid fa-xmark fa-sm"></i>`;
        divElement.appendChild(spanElement);

        const removeIconElement = spanElement.querySelector('.remove-name');
        removeIconElement.addEventListener('click', (event) => {
            event.target.parentElement.parentNode.removeChild(event.target.parentElement);
            const removedContent = event.target.parentElement.textContent.trim();
            addBackRemovedRow(removedContent, actualNumber); // Pass both content and phone number
            userInformation = removeRowFiltering(userInformation, content);
            console.log(userInformation);
        });

        const currentRow = document.querySelector(`tr[data-contactid="${content}"]`);
        if (currentRow && currentRow.parentNode) {
            currentRow.parentNode.removeChild(currentRow);
        } else {
            console.error(`Unable to find row with number: ${content}`);
        }
    }

    function addBackRemovedRow(content, phoneNumber) {
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-contactid', content);

        const profileCell = document.createElement('td');
        const profileIcon = document.createElement('i');
        profileIcon.classList.add('fa-regular');
        profileIcon.classList.add('fa-circle-user');
        profileIcon.classList.add('profilepic');
        profileCell.appendChild(profileIcon);

        const nameCell = document.createElement('td');
        nameCell.textContent = content;

        const numberCell = document.createElement('input');
        numberCell.type = 'hidden';
        numberCell.name = 'phoneNumber';
        numberCell.value = phoneNumber;

        const buttonCell = document.createElement('td');
        const addContactButton = document.createElement('button');
        addContactButton.classList.add('button');
        addContactButton.classList.add('add-contact');
        addContactButton.addEventListener('click', () => addContactNumber(content));
        addContactButton.innerHTML = `<i class="fa-solid fa-plus fa-sm"></i>`;
        buttonCell.appendChild(addContactButton);

        newRow.appendChild(profileCell);
        newRow.appendChild(nameCell);
        newRow.appendChild(numberCell);
        newRow.appendChild(buttonCell);

        table.appendChild(newRow);
    }

    function removeRowFiltering(data, targetValue) {
        return data.filter((row) => !row.includes(targetValue));
    }

    function updateChatHeaderName(fullName) {
        const chatHeaderElement = document.querySelector('.chat-header');
        const nameElement = chatHeaderElement.querySelector('.name');
        nameElement.textContent = fullName;
    }

    messageItemElements.forEach((element) => {
        element.addEventListener('click', () => {
            const messageItemContent = element.querySelector('.message-content');
            const fullName = messageItemContent.querySelector('.name').textContent;
            updateChatHeaderName(fullName);
        });
    });
</script>

</html>