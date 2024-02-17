# Oil Concession Project

This project focuses on managing the oil concessions in a particular region. With an interactive map, you can easily handle concessions, wells, tanks, and inspections. You can use the map to create concessions, wells, connect them to tanks, and view everything in one place. It's all about simplifying the management of oil resources in the region.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Contributing](#contributing)
- [License](#license)

## Installation

Provide instructions on how to install the project and its dependencies.

```bash
# Clone the repository
git clone https://github.com/SaadAhmed1122/Oil_Concession_GIS.git

# Navigate to the project directory
cd oil_concession

# Install dependencies
composer install

# Set up environment variables
cp .env.example .env
php artisan key:generate
```

## Usage

Explain how to use the project once it's installed. Include examples if applicable.

```bash
# Start the development server
php artisan serve

# Access the project in your browser
http://localhost:8000
```

## Features

List the key features of the project.

- Concession Management: Users should be able to select concessions via a map interface and set their names. On the map, all concessions will be visible. Clicking on a specific concession will display its details.
- Well Management : User are able to insert the data of well of selected concession and also user can insert the monthly production of that well and in show page user can see the list of well with monthly production as well as well as 12 month production of specific well.
- Tank Management : User able to add the location of tank with connection of well select from the map.
- Inspection Management : Users must have the ability to create, plan, modify, and cancel inspections.
Past inspections should be viewable, with options to filter by year, concession, andconcessionaire. 
- ...

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a pull request

## License

Specify the license under which the project is distributed. For example:

This project is licensed under the [UNIP](LICENSE).
