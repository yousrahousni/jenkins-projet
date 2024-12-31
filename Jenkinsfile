pipeline {
    agent any
    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/yousrahousni/jenkins-projet'
            }
        }
       
        stage('Build Docker Image') {
            steps {
                script {
                   
                    sh '''
                    docker build -t yousrahousni/jenkins-projet .
                    '''
                }
            }
        }
       
        stage('Tag Docker Image') {
            steps {
                script {
                    
                    sh '''
                    docker tag yousrahousni/jenkins-projet yousrahousni/jenkins-projet:latest
                    '''
                }
            }
        }

        stage('Push Image') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockeryousra', usernameVariable: 'DOCKER_USER', passwordVariable: 'DOCKER_PASS')]) {
                    script {
                        
                        sh '''
                        docker login -u $DOCKER_USER -p $DOCKER_PASS
                        docker push yousrahousni/jenkins-projet:latest
                        '''
                    }
                }
            }
        }
    }
    post {
        always {
            echo ' Image pusher.'
        }
    }
}
