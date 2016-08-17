FROM realpage/nginx:1.11
MAINTAINER Foundation DevOps foundation-devops@realpage.com
LABEL com.realpage.nginx.version="1.11"

# Copy the application public files to the container
ADD public /var/www/html/public
ADD resources/docs /var/www/html/resources/docs

WORKDIR /var/www/html

# Add Nodejs to Nginx NPM
RUN apk update && \
    apk add nodejs python make build-base && \

    # Update NPM for Aglio and Hercule
    npm install -g npm && \

    # Install Hercule for apib transclusion
    npm install -g hercule && \

    # Install Aglio for api doc html generation
    npm install -g aglio

    # Use Hercule to Concatenate .apib files
RUN hercule resources/docs/api-documentation.apib -o resources/docs/hercule.apib && \

    # Use Aglio to generate doc html file
    mkdir -p public/docs/v1 && \
    aglio --theme-variables streak -i resources/docs/hercule.apib -o public/docs/v1/index.html && \

    # Give access of public dir to nginx
    chown -R nginx:nginx public/

# Remove unneeded resources and make conf directory
RUN rm -rf resources/ && \
    npm uninstall -g aglio hercule && \
    apk del nodejs python make build-base

ADD infrastructure/nginx/default.conf.template /etc/nginx/conf.d/default.conf.template

# Make environment variables available in nginx config - see https://hub.docker.com/_/nginx/
# Required so we can use ${DOLLAR} in default.conf.. using just $ it gets replaced by envsubst
ENV DOLLAR=$
CMD envsubst < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf && nginx -g 'daemon off;'