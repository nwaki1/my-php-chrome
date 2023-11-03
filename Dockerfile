# Gunakan image nginx sebagai base image
FROM nginx:alpine

# Copy file HTML ke dalam direktori /usr/share/nginx/html di dalam container
COPY index.html /usr/share/nginx/html/
