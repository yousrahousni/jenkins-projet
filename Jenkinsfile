pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Cloner le dépôt GitHub
                git branch: 'main', url: 'https://github.com/yousrahousni/jenkins-projet.git'
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    
                    docker.build('yousrahousni/jenkins-projet:latest')
                }
            }
        }

        stage('Push Docker Image') {
            steps {
                script {
                    //ss
                    docker.withRegistry('https://registry.hub.docker.com', 'dockerhub-credentials') {
                        docker.image('yousrahousni/jenkins-projet:latest').push('latest')
                    }
                }
            }
        }
    }
}
