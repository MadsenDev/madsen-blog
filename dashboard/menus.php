<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Editor</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="content">
        <form action="save_menu.php" method="post" id="menu-form">
            <div class="menu-editor">
                <div class="menu-items">
                    <h2>Available Menu Items</h2>
                    <div class="menu-item">
                        <span class="menu-item-title">Home</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-item-title">About</span>
                    </div>
                    <div class="menu-item">
                        <span class="menu-item-title">Services</span>
                    </div>

                </div>

                <div class="menu-builder">
                    <h2>Menu Structure</h2>
                    <ul id="menu-structure">
                        <!-- Menu items will be added here -->
                    </ul>
                </div>
            </div>
            <button type="submit">Save Menu</button>
            </form>
        </div>
    </div>
    
    <script src="dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.querySelectorAll('.menu-item').forEach((menuItem) => {
            menuItem.addEventListener('click', () => {
                const clonedItem = menuItem.cloneNode(true);
                clonedItem.classList.add('sortable-item');
                const listItem = document.createElement('li');
                listItem.appendChild(clonedItem);
                document.querySelector('#menu-structure').appendChild(listItem);
            });
        });

        const sortable = new Sortable(document.getElementById('menu-structure'), {
            group: 'menu-structure',
            animation: 150,
            filter: '.menu-item',
            draggable: '.sortable-item',
        });

        document.querySelector('#menu-structure').addEventListener('click', (e) => {
            if (e.target.classList.contains('menu-item-title')) {
                e.target.parentElement.parentElement.remove();
            }
        });

        document.getElementById('menu-form').addEventListener('submit', (event) => {
            const menuStructure = Array.from(document.getElementById('menu-structure').children).map((listItem, index) => {
                const item = listItem.querySelector('.sortable-item');
                return {
                    id: index + 1,
                    icon: '', // Update this with the actual icon value
                    name: item.querySelector('.menu-item-title').textContent,
                    url: '', // Update this with the actual URL value
                    parent_id: null, // Update this with the actual parent_id value (if any)
                    position: index,
                    custom_class: '' // Update this with the actual custom class value (if any)
                };
            });

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'menu-items';
            input.value = JSON.stringify(menuStructure);
            event.target.appendChild(input);
        });
    </script>
</body>
</html>