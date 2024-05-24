<?php

it('returns a customizable dummy image', function () {
    expect(ImageHelp::getDummyImageUrl())->toEqual('https://dummyimage.com/600x400/000/fff.png&text=Placeholder+Image')
        ->and(ImageHelp::getDummyImageUrl(format: 'jpg'))->toEqual('https://dummyimage.com/600x400/000/fff.jpg&text=Placeholder+Image');
});

it('returns a dummy image with custom dimensions', function () {
    expect(ImageHelp::getDummyImageUrl(width: '800', height: '600'))
        ->toEqual('https://dummyimage.com/800x600/000/fff.png&text=Placeholder+Image');
});

it('returns a dummy image with custom colors', function () {
    expect(ImageHelp::getDummyImageUrl(backgroundColor: '123', fontColor: '456'))
        ->toEqual('https://dummyimage.com/600x400/123/456.png&text=Placeholder+Image');
});

it('returns a dummy image with custom text', function () {
    expect(ImageHelp::getDummyImageUrl(text: 'Custom Text'))
        ->toEqual('https://dummyimage.com/600x400/000/fff.png&text=Custom+Text');
});

it('returns a dummy image with all custom parameters', function () {
    expect(ImageHelp::getDummyImageUrl(
        width: '800',
        height: '600',
        backgroundColor: '123',
        fontColor: '456',
        format: 'jpg',
        text: 'Custom Text'
    ))->toEqual('https://dummyimage.com/800x600/123/456.jpg&text=Custom+Text');
});