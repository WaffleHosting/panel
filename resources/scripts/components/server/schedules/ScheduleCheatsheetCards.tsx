import React from "react";
import tw from "twin.macro";

export default () => {
  return (
    <>
      <div css={tw`md:w-1/2 h-full bg-[#060606]`}>
        <div css={tw`flex flex-col`}>
          <h2 css={tw`py-4 px-6 font-bold`}>Examples</h2>
          <div css={tw`flex py-4 px-6 bg-[#050505]`}>
            <div css={tw`w-1/2`}>*/5 * * * *</div>
            <div css={tw`w-1/2`}>ทุกๆ 5 นาที</div>
          </div>
          <div css={tw`flex py-4 px-6`}>
            <div css={tw`w-1/2`}>0 */1 * * *</div>
            <div css={tw`w-1/2`}>ทุกๆชั่วโมง</div>
          </div>
          <div css={tw`flex py-4 px-6 bg-[#050505]`}>
            <div css={tw`w-1/2`}>0 8-12 * * *</div>
            <div css={tw`w-1/2`}>ช่วงของชั่วโมง</div>
          </div>
          <div css={tw`flex py-4 px-6`}>
            <div css={tw`w-1/2`}>0 0 * * *</div>
            <div css={tw`w-1/2`}>เกิดขึ้นครั้งเดียวในแต่ละวัน</div>
          </div>
          <div css={tw`flex py-4 px-6 bg-[#050505]`}>
            <div css={tw`w-1/2`}>0 0 * * MON</div>
            <div css={tw`w-1/2`}>ทุกวันจันทร์</div>
          </div>
        </div>
      </div>
      <div css={tw`md:w-1/2 h-full bg-[#060606]`}>
        <h2 css={tw`py-4 px-6 font-bold`}>ตัวอักษร</h2>
        <div css={tw`flex flex-col`}>
          <div css={tw`flex py-4 px-6 bg-[#050505]`}>
            <div css={tw`w-1/2`}>*</div>
            <div css={tw`w-1/2`}>ค่าใดๆ</div>
          </div>
          <div css={tw`flex py-4 px-6`}>
            <div css={tw`w-1/2`}>,</div>
            <div css={tw`w-1/2`}>ตัวอักษรหรือสัญลักษณ์ที่ใช้</div>
          </div>
          <div css={tw`flex py-4 px-6 bg-[#050505]`}>
            <div css={tw`w-1/2`}>-</div>
            <div css={tw`w-1/2`}>ช่วง</div>
          </div>
          <div css={tw`flex py-4 px-6`}>
            <div css={tw`w-1/2`}>/</div>
            <div css={tw`w-1/2`}>การกำหนดช่วง</div>
          </div>
        </div>
      </div>
    </>
  );
};
