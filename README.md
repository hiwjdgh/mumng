# 무명

누구나 웹툰 작가로 도전할 수 있는 웹툰 플랫폼 "무명"

## 스택

Server          : AWS Lightsail(Linux Debian)</br>
DB              : mysql</br>
Back-end        : PHP</br>
Front-end       : HTML5, Sass, Java Script</br>

## 구조

mumng/</br>
├── api/</br>
├── data/</br>
├── root/</br>
│   ├── css/</br>
│   ├── font/</br>
│   ├── icon/</br>
│   ├── img/</br>
│   ├── js/</br>
│   ├── lib/</br>
│   ├── plugin/</br>
├── theme/</br>
└── view/</br>
├── _common.php</br>
├── bottom.php</br>
├── common.php</br>
├── config.php</br>
├── footer.php</br>
├── header.php</br>
├── index.php</br>
├── robot.txt</br>
├── sitemap.xml</br>
├── top.php</br>

1. api 디렉토리
- 프로젝트에 필요한 API 함수들을 모듈 또는 페이지별로 담고 있습니다.

2. data 디렉토리
- 사용자에 의해 생성된 여러 이미지, 파일등을 담고 있습니다.

3. root 디렉토리
- 프로젝트를 위한 정적 파일 및 라이브러리등을 담고 있습니다.

3-1. css 디렉토리
- 프로젝트에서 사용하는 공통적인 스타일시트 파일을 담고 있습니다.

3-2. font 디렉토리
- 프로젝트에서 사용하는 폰트를 담고 있습니다.

3-3. icon 디렉토리
- 프로젝트에서 사용하는 아이콘을 담고 있습니다.

3-4. img 디렉토리
- 프로젝트에서 사용하는 이미지를 담고 있습니다.

3-5. js 디렉토리
- 프로젝트에서 사용하는 공통적인 jquery 및 변환 유틸, 커스텀 컴포넌트에 대한 파일을 담고 있습니다.

3-6. plugin 디렉토리
- 프로젝트에서 사용하는 플러그인 요소를 포함 하고 있으며 직접 개발하지 않은 기능은 해당 폴더에 담습니다.

3-6. lib 디렉토리
- 프로젝트에서 사용하는 모든 모듈을 포함 하고 있습니다.

4. theme 디렉토리
- 각 페이지별로 렌더링 되는 파일을 담고 있습니다.

5. view 디렉토리
- 프로젝의 각 페이지별 로직을 수행 하는 파일을 담고 있습니다.

6. _common.php 파일
- common.php 파일을 불러오기 위한 파일입니다.

7. bottom.php 파일
- 웹사이트의 하단 파일로서 html 및 body의 끝을 담고 있으며, 방문로그가 실행 됩니다.

8. common.php 파일
- 공통 설정 및 필요 라이브러리를 불러오는 파일이며 어느 곳에서는 이 파일이 불러와집니다.

9. config.php 파일
- 프로젝트의 설정 파일입니다. 상수 파일이 주를 이룹니다.

10. footer 파일
- 프로젝트의 하단 파일, 즉 footer 레이아웃을 렌더링 하기 위한 파일로 공통적으로 불러오는 파일이며 로직 처리가 가능합니다.

11. header 파일
- 프로젝트의 상단 파일, 즉 header 레이아웃을 렌더링 하기 위한 파일로 공통적으로 불러오는 파일이며 로직 처리가 가능합니다.

12. index 파일
- 프로그램의 진입점(entry point)으로 사용되는 파일입니다. URL을 이용한 파일 분기를 실행합니다.

## Authors

* **Jeongho Choi**
