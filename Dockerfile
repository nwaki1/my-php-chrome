# Gunakan image nginx sebagai base image
FROM nginx:alpine

# Copy file konfigurasi nginx kustom ke dalam container
COPY nginx.conf /etc/nginx/nginx.conf

# Copy file HTML ke dalam direktori /usr/share/nginx/html di dalam container
COPY index.html /usr/share/nginx/html/
