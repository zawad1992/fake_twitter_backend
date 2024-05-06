kubectl apply -f mariadb-deployment.yml
kubectl apply -f faketwitter-fpm-deployment.yml
kubectl apply -f faketwitter-nginx-deployment.yml

kubectl apply -f mariadb-service.yml
kubectl apply -f faketwitter-fpm-service.yml
kubectl apply -f faketwitter-nginx-service.yml

