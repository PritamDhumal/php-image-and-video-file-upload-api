
# php-image-and-video-file-upload-api


---

This repository contains a PHP-based API for uploading image and video files to a server. The API supports secure file uploads using an API key for authentication. It allows users to upload JPEG, PNG, and MP4 files. The project is easy to set up and integrate with your frontend or mobile application. Feel free to contribute or report issues.

---


## Authors

- [@PritamDhumal](https://github.com/PritamDhumal)


## Features

- Upload image files (JPEG, PNG)
- Upload video files (MP4)
- Authentication using API key


## Environment Variables

- PHP 7.0 or higher
- Web server (Apache, Nginx, etc.)
- Composer (for dependency management)


## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/PritamDhumal/php-image-and-video-file-upload-api.git
    cd php-image-and-video-file-upload-api
    ```

2. Install dependencies (if any):
    ```sh
    composer install
    ```

3. Configure your web server to serve the files in the repository.

4. Edit the `imgandvideo.php` file to set your secret API key.
    
## Usage

- Set your secret API key in the imgandvideo.php file:
```sh
define('API_KEY', 'YOUR_SECRET_API_KEY');
```
- Use a tool like Postman or curl to test the API.
- Integrate the API with your frontend or mobile application.





## Example

---

#### Headers

- `API-Key`: Your secret API key

#### Body

- `file`: The file to be uploaded (image or video)

#### Example Request

```sh
curl -X POST https://yourdomain.com/imgandvideo.php \
     -H "API-Key: YOUR_SECRET_API_KEY" \
     -F "file=@/path/to/your/file.jpg"
```



#### Response

- '200 OK' if the file is successfully uploaded.

- '400 Bad Request' if the file is not provided or the file type is unsupported.

- '401 Unauthorized' if the API key is missing or invalid.

#### Example Response
```sh
{
    "status": "success",
    "message": "File uploaded successfully",
    "file_path": "/uploads/file.jpg"
}
```



## Contributing

Contributions are always welcome!

Feel free to submit issues and enhancement requests.

